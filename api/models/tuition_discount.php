<?php
class TuitionDiscount extends AppModel {
	var $name = 'TuitionDiscount';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Tuition' => array(
			'className' => 'Tuition',
			'foreignKey' => 'tuition_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Discount' => array(
			'className' => 'Discount',
			'foreignKey' => 'discount_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
