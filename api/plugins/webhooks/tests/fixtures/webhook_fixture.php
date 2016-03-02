<?php
/* Webhook Fixture generated on: 2016-03-02 02:39:34 : 1456886374 */
class WebhookFixture extends CakeTestFixture {
	var $name = 'Webhook';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'event_source' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'target_source' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => '56d65266-48b4-4562-b343-1754a99a9a43',
			'event_source' => 'Lorem ip',
			'target_source' => 'Lorem ip',
			'created' => '2016-03-02 02:39:34',
			'modified' => '2016-03-02 02:39:34'
		),
	);
}
