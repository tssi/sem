<?php
class Reservation extends AppModel {
	var $name = 'Reservation';
	var $displayField = 'name';
	var $recursive = 2;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => array(
				'Student.sno',
				'Student.gender',
				'Student.short_name',
				'Student.full_name',
				'Student.class_name',
				'Student.status',
				'Student.year_level_id',
				'Student.section_id',
			),
			'order' => ''
		),
		'Inquiry' => array(
			'className' => 'Inquiry',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

	
}
