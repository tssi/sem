<?php
class Scheme extends AppModel {
	var $name = 'Scheme';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'PaymentDueDate' => array(
			'className' => 'PaymentDueDate',
			'foreignKey' => 'scheme_id',
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
		'PaymentScheme' => array(
			'className' => 'PaymentScheme',
			'foreignKey' => 'scheme_id',
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
