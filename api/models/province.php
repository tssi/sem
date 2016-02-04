<?php
class Province extends AppModel {
	var $name = 'Province';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $order = 'order';
	var $belongsTo = array(
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'province_id',
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
