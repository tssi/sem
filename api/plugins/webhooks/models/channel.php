<?php
class Channel extends WebhooksAppModel {
	var $name = 'Channel';
	var $useDbConfig = 'app';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'ChannelEvent' => array(
			'className' => 'Webhooks.ChannelEvent',
			'foreignKey' => 'channel_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ChannelField' => array(
			'className' => 'Webhooks.ChannelField',
			'foreignKey' => 'channel_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
