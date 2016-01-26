<?php
/* Country Fixture generated on: 2016-01-26 07:39:04 : 1453790344 */
class CountryFixture extends CakeTestFixture {
	var $name = 'Country';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 2, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'call_code' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 2),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => '',
			'name' => 'Lorem ipsum dolor sit amet',
			'call_code' => 1
		),
	);
}
