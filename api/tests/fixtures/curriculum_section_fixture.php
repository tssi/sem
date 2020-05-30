<?php
/* CurriculumSection Fixture generated on: 2020-05-30 12:19:26 : 1590812366 */
class CurriculumSectionFixture extends CakeTestFixture {
	var $name = 'CurriculumSection';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'section_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'curriculum_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'esp' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '6,2'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'section_id' => 1,
			'curriculum_id' => 'Lorem ip',
			'esp' => 1,
			'created' => '2020-05-30 12:19:26',
			'modified' => '2020-05-30 12:19:26'
		),
	);
}
