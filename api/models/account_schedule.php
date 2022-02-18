<?php
class AccountSchedule extends AppModel {
	var $name = 'AccountSchedule';
	var $useDbConfig = 'srp';
	//var $useDbConfig = 'sfm';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
	);
	
	function findSched($sid){
		return $scheds = $this->find('all',array('conditions'=>array('AccountSchedule.account_id'=>$sid)));
	}
}
