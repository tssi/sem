<?php
class ChannelEvent extends WebhooksAppModel {
	var $name = 'ChannelEvent';
	var $useDbConfig = 'app';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Channel' => array(
			'className' => 'Webhooks.Channel',
			'foreignKey' => 'channel_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
