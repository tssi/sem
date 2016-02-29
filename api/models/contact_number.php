<?php
class ContactNumber extends AppModel {
	var $name = 'ContactNumber';
	var $useDbConfig = 'sim';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'student_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
