<?php
/* AssessmentAdjustment Fixture generated on: 2016-02-23 02:00:43 : 1456192843 */
class AssessmentAdjustmentFixture extends CakeTestFixture {
	var $name = 'AssessmentAdjustment';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'assessment_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'item_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'flag' => array('type' => 'string', 'null' => true, 'default' => '+', 'length' => 1, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'amount' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'assessment_id' => 1,
			'item_code' => 'L',
			'flag' => 'Lorem ipsum dolor sit ame',
			'amount' => 1,
			'created' => '2016-02-23 02:00:43',
			'modified' => '2016-02-23 02:00:43'
		),
	);
}
