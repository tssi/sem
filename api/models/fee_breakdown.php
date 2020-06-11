<?php
class FeeBreakdown extends AppModel {
	var $name = 'FeeBreakdown';
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Tuition' => array(
			'className' => 'Tuition',
			'foreignKey' => 'tuition_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Fee' => array(
			'className' => 'Fee',
			'foreignKey' => 'fee_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
