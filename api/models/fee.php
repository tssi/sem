<?php
class Fee extends AppModel {
	var $name = 'Fee';
	var $displayField = 'name';
	var $useDbConfig = 'srp';
	var $recursive = 2;
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'FeeBreakdown' => array(
			'className' => 'FeeBreakdown',
			'foreignKey' => 'fee_id',
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
