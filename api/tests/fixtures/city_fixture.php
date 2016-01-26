<?php
/* City Fixture generated on: 2016-01-26 07:39:03 : 1453790343 */
class CityFixture extends CakeTestFixture {
	var $name = 'City';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 3, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 150, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'province_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'is_active' => array('type' => 'boolean', 'null' => true, 'default' => NULL, 'comment' => 'Is Show On Drop Down'),
		'zip_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 4, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'area_code' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'province_id' => 'L',
			'is_active' => 1,
			'zip_code' => 'Lo',
			'area_code' => 1
		),
	);
}
