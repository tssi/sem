<?php
/* ChannelField Fixture generated on: 2016-03-02 02:35:37 : 1456886137 */
class ChannelFieldFixture extends CakeTestFixture {
	var $name = 'ChannelField';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'channel_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 6, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'field' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'channel_id' => 'Lore',
			'field' => 'Lorem ipsum dolor sit amet',
			'created' => '2016-03-02 02:35:37',
			'modified' => '2016-03-02 02:35:37'
		),
	);
}
