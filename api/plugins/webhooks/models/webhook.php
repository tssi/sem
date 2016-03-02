<?php
class Webhook extends WebhooksAppModel {
	var $name = 'Webhook';
	var $useDbConfig = 'app';
	var $actsAs = array('Containable');
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'EventSource' => array(
			'className' => 'Webhooks.ChannelEvent',
			'foreignKey' => 'event_source',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'EventTarget' => array(
			'className' => 'Webhooks.ChannelEvent',
			'foreignKey' => 'event_target',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $hasMany = array(
		'WebhookField' => array(
			'className' => 'Webhooks.WebhookField',
			'foreignKey' => 'webhook_id',
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

	
	function afterFind($results){
		if(isset($results[0]['Webhook'])){
			$channels =  array();
			$channel_ids = array();
			foreach($this->EventSource->find('all') as $source){
				$channels[$source['Channel']['id']] = $source['Channel'];
				array_push($channel_ids,$source['Channel']['id']);
			}
			$conditions = array('NOT'=>array('Channel.id'=>$channel_ids));
			
			foreach($this->EventTarget->find('all',compact('conditions')) as $target){
				$channels[$target['Channel']['id']] = $target['Channel'];
			}
			
			foreach($results as $index=>$result){
				if(isset($result['EventSource'])&&isset($result['EventTarget'])){
					$webhookFields = array();
					$conditions = array('webhook_id'=>$result['Webhook']['id']);
					foreach($this->WebhookField->find('all',compact('conditions')) as $field){
						unset($field['WebhookField']['id']);
						unset($field['WebhookField']['webhook_id']);
						unset($field['WebhookField']['created']);
						unset($field['WebhookField']['modified']);
						array_push($webhookFields,$field['WebhookField']);
					}
					$webhook = array();
					$target_channel = $channels[$result['EventTarget']['channel_id']];
					$webhook['url'] = $target_channel['base_url'].$target_channel['endpoint'];
					$webhook['method'] = $result['EventSource']['method'];
					$webhook['fields'] = $webhookFields;
					$results[$index]['Webhook'] = array_merge($results[$index]['Webhook'],$webhook);
				}
			}
		}
		return $results;
	}
}
