<?php
class Account extends AppModel {
	var $name = 'Account';
	var $useDbConfig = 'srp';
	
	var $belongsTo = array(
		
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'id',
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
	);
}