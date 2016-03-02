<?php
class ChannelField extends WebhooksAppModel {
	var $name = 'ChannelField';
	var $useDbConfig = 'app';
	var $virtualFields = array('name'=>'CONCAT(ChannelField.channel_id,".",ChannelField.field)');
	var $displayField = 'name';
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
