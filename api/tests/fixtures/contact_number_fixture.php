<?php
/* ContactNumber Fixture generated on: 2016-02-04 08:58:52 : 1454576332 */
class ContactNumberFixture extends CakeTestFixture {
	var $name = 'ContactNumber';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'student_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 12, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'student_id' => 1,
			'type' => 'Lorem ip',
			'number' => 'Lorem ipsu',
			'created' => '2016-02-04 08:58:52',
			'modified' => '2016-02-04 08:58:52'
		),
	);
}
