<?php
/* Schedule Fixture generated on: 2020-05-29 21:56:20 : 1590760580 */
class ScheduleFixture extends CakeTestFixture {
	var $name = 'Schedule';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 8, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'key' => 'primary'),
		'section_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'esp' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '6,2'),
		'created' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'indexes' => array(),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 'Lorem ',
			'section_id' => 1,
			'esp' => 1,
			'created' => 1590760580,
			'modified' => 1590760580
		),
	);
}
