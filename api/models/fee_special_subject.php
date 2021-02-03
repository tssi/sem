<?php
class FeeSpecialSubject extends AppModel {
	var $name = 'FeeSpecialSubject';
	var $displayField = 'name';
	var $recursive = 2;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Subject' => array(
			'className' => 'Subject',
			'foreignKey' => 'subject_id',
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
		),
	);


}
