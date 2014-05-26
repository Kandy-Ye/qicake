<?php
/* User Fixture generated on: 2013-09-11 20:17:35 : 1378901855 */
class UserFixture extends CakeTestFixture {
	var $name = 'User';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'avatar' => array('type' => 'string', 'null' => true, 'default' => 'avatars/predefined/default.gif', 'length' => 2048, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'avatar_big' => array('type' => 'string', 'null' => true, 'default' => 'avatars/predefined/default_big.gif', 'length' => 2048, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'point' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'level' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'exp' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'status' => array('type' => 'string', 'null' => false, 'default' => 'CREATED', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'referrer' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index'),
		'ip' => array('type' => 'string', 'null' => false, 'default' => '0', 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'statusflag' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'email' => array('column' => 'email', 'unique' => 0), 'ip' => array('column' => 'ip', 'unique' => 0), 'name' => array('column' => 'name', 'unique' => 0), 'created' => array('column' => 'created', 'unique' => 0), 'modified' => array('column' => 'modified', 'unique' => 0), 'referrer' => array('column' => 'referrer', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet',
			'avatar' => 'Lorem ipsum dolor sit amet',
			'avatar_big' => 'Lorem ipsum dolor sit amet',
			'point' => 1,
			'level' => 1,
			'exp' => 1,
			'status' => 'Lorem ipsum dolor sit amet',
			'group_id' => 1,
			'referrer' => 1,
			'ip' => 'Lorem ipsum dolor sit amet',
			'statusflag' => 1,
			'created' => '2013-09-11 20:17:35',
			'modified' => 1378901855
		),
	);
}
