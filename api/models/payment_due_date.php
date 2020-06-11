<?php
class PaymentDueDate extends AppModel {
	var $name = 'PaymentDueDate';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Scheme' => array(
			'className' => 'Scheme',
			'foreignKey' => 'scheme_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
