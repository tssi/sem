<?php
/* ScheduleDetail Fixture generated on: 2020-05-29 12:14:43 : 1590725683 */
class ScheduleDetailFixture extends CakeTestFixture {
	var $name = 'ScheduleDetail';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'schedule_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 8, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'start_time' => array('type' => 'time', 'null' => true, 'default' => NULL),
		'end_time' => array('type' => 'time', 'null' => true, 'default' => NULL),
		'days' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'room_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 4, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'indexes' => array('id' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'schedule_id' => 'Lorem ',
			'start_time' => '12:14:43',
			'end_time' => '12:14:43',
			'days' => 'Lorem ipsum dolor sit ame',
			'room_id' => 'Lo',
			'created' => 1590725683,
			'modified' => 1590725683
		),
	);
}
