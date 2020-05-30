<?php
/* CurriculumDetail Fixture generated on: 2020-05-30 12:19:11 : 1590812351 */
class CurriculumDetailFixture extends CakeTestFixture {
	var $name = 'CurriculumDetail';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'curriculum_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'year_level_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 2, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'subject_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 8, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'under' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 8, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'weight' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '8,4'),
		'unit' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '4,2'),
		'lec_hour' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '4,2'),
		'lab_hour' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '4,2'),
		'is_parent' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'is_load' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'is_print' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'is_conduct' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'is_average' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'indention' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 2),
		'print_on' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'order' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'curriculum_id' => 'Lorem ip',
			'year_level_id' => '',
			'subject_id' => 'Lorem ',
			'under' => 'Lorem ',
			'weight' => 1,
			'unit' => 1,
			'lec_hour' => 1,
			'lab_hour' => 1,
			'is_parent' => 1,
			'is_load' => 1,
			'is_print' => 1,
			'is_conduct' => 1,
			'is_average' => 1,
			'indention' => 1,
			'print_on' => 'Lorem ipsum dolor sit amet',
			'order' => 1,
			'created' => '2020-05-30 12:19:11',
			'modified' => '2020-05-30 12:19:11'
		),
	);
}
