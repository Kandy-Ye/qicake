<?php
class SettingsController extends AppController {
	
	public $uses = array('Setting');
	
	public $helpers = array('Fck');
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
		parent::beforeFilter();
	}

	public function admin_index() {
		$this->paginate = array('limit' => 200);

			$this->set('settings1', $this->paginate());
	}

	public function admin_view($id = null) {
		if (!is_numeric($id)) {
			$this->cakeError('invalidArgument');
		}

		$this->set('setting', $this->Setting->read(null, $id));
	}

	public function admin_edit($id = null){
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Setting', true));
			$this->redirect(array('action'=>'index'));
		}

		if (!empty($this->data)) {
			if ($this->Setting->save($this->data)) {
				$this->flash(__('The Setting has been saved', true), array('action'=>'index'));
			} else {
				$this->flash(__('The Setting could not be saved. Please, try again.', true), array('action'=>'index'));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Setting->read(null, $id);
		//	$this->set('groups', $this->User->Group->find('list'));
		}
		
	}
}
?>