<?php
/* Barangay Fixture generated on: 2016-01-26 06:44:29 : 1453790669 */
class BarangayFixture extends CakeTestFixture {
	var $name = 'Barangay';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 150, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'city_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'is_active' => array('type' => 'boolean', 'null' => true, 'default' => NULL, 'comment' => 'Is Show On Drop Down'),
		'zip_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 4, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'city_id' => 1,
			'is_active' => 1,
			'zip_code' => 'Lo'
		),
	);
}
