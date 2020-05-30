<?php
/* UserType Fixture generated on: 2020-05-29 10:54:21 : 1590720861 */
class UserTypeFixture extends CakeTestFixture {
	var $name = 'UserType';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 'Lor',
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => '2020-05-29 10:54:21',
			'modified' => '2020-05-29 10:54:21'
		),
	);
}
