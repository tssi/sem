<?php
class WebhookField extends WebhooksAppModel {
	var $name = 'WebhookField';
	var $useDbConfig = 'app';
	var $actsAs = array('Containable');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Webhook' => array(
			'className' => 'Webhooks.Webhook',
			'foreignKey' => 'webhook_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
}
