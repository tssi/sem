<?php
/* BillingPeriod Fixture generated on: 2016-02-05 08:11:19 : 1454659879 */
class BillingPeriodFixture extends CakeTestFixture {
	var $name = 'BillingPeriod';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 4, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'payment_frequency' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 'Lo',
			'name' => 'Lorem ipsum dolor sit amet',
			'payment_frequency' => 1,
			'created' => '2016-02-05 08:11:19',
			'modified' => '2016-02-05 08:11:19'
		),
	);
}
