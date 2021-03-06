<?php 
App::import('Lib', array('function_core', 'ip'));

define('TIME_START', time());
define('CLIENT_IP', IPv6ToIPv4MappedFormat(getRealRemoteIp()));

class AppController extends Controller {

	public $components = array(
		'Session', 'Acl', 'Auth', 
		'Cookie' => array('name' => COOKIE_NAME, 'key' => COOKIE_KEY, 'time' => 3600, 'path' => '/', 'secure' => false), 
		'Email', 'UserTracker'
	);

  // Default current user is anonymous user
	public $currentUser = array(
		'id' => 0,
		'email' => USER_ANONYMOUS_EMAIL,
		'name' => USER_ANONYMOUS_NAME,
		'password' => '',
		'avatar' => AVATAR_DEFAULT,
		'avatar_big' => AVATAR_DEFAULT,
		'group_id' => USER_GROUP_ID,
		'point' => 0, 'level' => 0, 'exp' => 0, 
		'created' => '1970-01-01 00:00:00', 'modified' => '1970-01-01 00:00:00',
		'status' => 'ACTIVATED', 'gender' => '', 'birth' => '', 'referrer' => 0, 
		'salary' => '', 'ip' => '');

	public $currentEnterprise = array('id' => 0,
		'email' => USER_ANONYMOUS_EMAIL,
		'name' => USER_ANONYMOUS_NAME,
		'group_id' => ENTERPRISE_GROUP_ID
	);

	public $settings = array();

	public $uniqueCookie = null;

	public function beforeFilter() {
		parent::beforeFilter();

		$this->settings = $this->_loadSettings();

    // Timezone setting
	  date_default_timezone_set('Asia/Shanghai');

		// Session accross all domain
		ini_set('session.cookie_domain', env('HTTP_BASE'));

		$this->Auth->allow('*');

		// Current user
		if ($this->Session->check('Auth.User')) {
			$this->_updateUser($this->Session->read('Auth.User'));
		}

		$this->_setAuth();
	}

	public function beforeRender() {
		// Current user
		$this->set('currentUser', $this->currentUser);
		$this->set('settings', $this->settings);
		$this->set('title_for_layout', DEFAULT_TITLE);
		$this->set('meta_keywords', DEFAULT_KEYWORDS);
		$this->set('meta_description', DEFAULT_DESCRIPTION);

    if (isset($this->params['named']['preview']) && $this->params['named']['preview']) {
      $this->layout = 'preview';
    }

    if ($this->_isAdmin()) {
    	// $this->layout = 'admin';
    }

    // Javascript support is supplied by default
    array_push($this->helpers, 'Js');
	}

	public function afterFilter() {
		if ($this->_needLogAction()) {
        	$db =& ConnectionManager::getDataSource(STAT_DB);

			// Logging
        	$sql = sprintf("INSERT INTO `stat_accesses` (`controller`, `action`, `param1`, `param2`, `param3`, `ip`, `referer`, `uucookie`, `user_id`) "
                                    ."VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d)",
                                $this->params['controller'], $this->params['action'], 
                                isset($this->params['pass'][0]) ? $this->params['pass'][0] : null,
                                isset($this->params['pass'][1]) ? $this->params['pass'][1] : null,
                                isset($this->params['pass'][2]) ? $this->params['pass'][2] : null,
                                CLIENT_IP, 
                                isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null,
                                $this->uniqueCookie,
                                $this->currentUser['id']);
    		// $db->query($sql);
		}
	}

	/**
	 * Serialization. The result is depend on the type
	 *
	 * @param string $id Id of the user to be serialized, if $id is null, return current user
	 * @param string $type How to serialize the object, the possible type can be 'json', 'xml', 'string', 'variables', etc
	 * 'json' and 'string' has been implemented currently
	 * @access public
	 */
	public function serialize($id = null, $type = 'json') {
		if ($type == 'json') {
			echo $this->jsonify($id);
		}
		else if ($type == 'xml'){
			// TODO
			echo 'not implemented';
		}
		else if ($type == 'printify') {
			$this->printify($id);
		}
		else {
			echo $this->toString();
		}

		Configure::Write('debug', 0);
		$this->autoRender = false;
	}

	/**
	 * serialize the object in json format
	 *
	 * @param string $id Id of the user to be jsonify
	 * @access public
	 */
	protected function jsonify($id = null) {
		return json_encode($this->_load($id));
	}

	/**
	 * serialize the object in print_r format
	 *
	 * @param string $id Id of the user to be printify
	 * @access public
	 */
	protected function printify($id = null) {
		echo '<pre>';
		print_r($this->_load($id));
		echo '</pre>';
	}

	protected function _load($id = null, $fields = null, $contain = null) {
		return array($id);
	}

	protected function _loadSettings() {
    if (($settings = Cache::read("settings", 'hourly')) === false) {
    	$db =& ConnectionManager::getDataSource('default');
			$sql = 'SELECT * FROM `settings` AS `Setting`';
			$settings = $db->query($sql);

			$settings2 = array();
			foreach ($settings as $setting) {
				$settings2[$setting['Setting']['skey']] = $setting['Setting']['svalue'];
			}

			$settings = $settings2;
			Cache::write("settings", $settings, 'hourly');
    }

    return $settings;
	}

	protected function _setAuth() {
    $this->Auth->fields = array('username' => 'email', 'password' => 'password');
    $this->Auth->authorize = 'actions'; // Every request will be checked using $this->Acl->check($aro, '/controllers/{controller}/{action}')
    $this->Auth->actionPath = 'controllers/';
    $this->Auth->userScope = array('User.status' => 'ACTIVATED');
    $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
    // $this->Auth->autoRedirect = false;
    $this->Auth->logoutRedirect = '/';

		// Specified Authorization
		if ($this->_isAdmin()){
			// Allways in debug mode
      ini_set("max_execution_time", "180");
			if (Configure::read() == 0) {
				Configure::write('debug', 1);
			}

	    $this->Auth->loginAction = array('controller' => 'users', 'action' => 'admin_login');
		}
	}

	protected function _isAdmin(){
		return isset($this->params['prefix']) && ($this->params['prefix'] === 'admin');
	}

	protected function _needLogAction() {
		// This program need no log
		return false;

		$blackList = array('image', 'css', 'js');
		$controller = $this->params['controller'];
		if (in_array($controller, $blackList) || $this->_isAdmin()) {
			return false;
		}

		return true;
	}

  protected function _updateUser($user) {
    if (!$user['id']) {
      return ;
    }

    $db =& ConnectionManager::getDataSource('default');
		$sql = "SELECT `User`.* FROM `users` AS `User` WHERE `User`.`id`=$user[id]";
		$data = $db->query($sql);
        $this->currentUser = array_merge($user, $data[0]['User']);
  }

}
?>
