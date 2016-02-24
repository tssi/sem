<?php
/* AssessmentSchedule Fixture generated on: 2016-02-23 02:00:35 : 1456192835 */
class AssessmentScheduleFixture extends CakeTestFixture {
	var $name = 'AssessmentSchedule';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'assessment_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'bill_month' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 8, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'due_date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'due_amount' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'paid_amount' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'assessment_id' => 1,
			'bill_month' => 'Lorem ',
			'due_date' => '2016-02-23',
			'due_amount' => 1,
			'paid_amount' => 1,
			'created' => '2016-02-23 02:00:35',
			'modified' => '2016-02-23 02:00:35'
		),
	);
}
