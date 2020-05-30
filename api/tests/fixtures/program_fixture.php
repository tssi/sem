<?php
/* Program Fixture generated on: 2020-05-29 10:51:42 : 1590720702 */
class ProgramFixture extends CakeTestFixture {
	var $name = 'Program';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 5, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'key' => 'primary'),
		'department_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 2, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'description' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'alias' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'order' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array(),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 'Lor',
			'department_id' => '',
			'name' => 'Lorem ipsum dolor ',
			'description' => 'Lorem ipsum dolor sit amet',
			'alias' => 'Lorem ip',
			'order' => 1,
			'created' => '2020-05-29 10:51:42',
			'modified' => '2020-05-29 10:51:42'
		),
	);
}
