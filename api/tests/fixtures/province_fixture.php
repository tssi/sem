<?php
/* Province Fixture generated on: 2016-01-26 06:52:44 : 1453791164 */
class ProvinceFixture extends CakeTestFixture {
	var $name = 'Province';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 3, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 150, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'country_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 2, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'is_active' => array('type' => 'boolean', 'null' => true, 'default' => NULL, 'comment' => 'Is Show On Drop Down'),
		'seq_order' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 'L',
			'name' => 'Lorem ipsum dolor sit amet',
			'country_id' => '',
			'is_active' => 1,
			'seq_order' => 1
		),
	);
}
