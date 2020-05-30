<?php
/* UserGrant Fixture generated on: 2020-05-29 10:54:04 : 1590720844 */
class UserGrantFixture extends CakeTestFixture {
	var $name = 'UserGrant';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_type_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 5, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'master_module_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'FK_grn_usr' => array('column' => 'user_type_id', 'unique' => 0), 'FK_grn_mod' => array('column' => 'master_module_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'user_type_id' => 'Lor',
			'master_module_id' => 1,
			'created' => '2020-05-29 10:54:04',
			'modified' => '2020-05-29 10:54:04'
		),
	);
}
