<?php
/* AssessmentFee Fixture generated on: 2016-02-23 01:59:30 : 1456192770 */
class AssessmentFeeFixture extends CakeTestFixture {
	var $name = 'AssessmentFee';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'assessment_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'fee_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'fee_id' => 'L',
			'due_amount' => 1,
			'paid_amount' => 1,
			'created' => '2016-02-23 01:59:30',
			'modified' => '2016-02-23 01:59:30'
		),
	);
}
