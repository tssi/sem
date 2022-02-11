<?php
class ClasslistIrregular extends AppModel {
	var $name = 'ClasslistIrregular';
	var $recursive = 2;
	var $useDbConfig = 'ser';
	//var $cacheExpires = '+1 day';
	//var $usePaginationCache = true;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'student_id',
			'conditions' => '',
			'fields' => array(
				'Student.id',
				'Student.sno',
				'Student.lrn',
				'Student.classroom_user_id',
				'Student.gender',
				'Student.short_name',
				'Student.full_name',
				'Student.class_name',
				'Student.status',
				),
			'order' => ''
		),
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'section_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Subject' => array(
			'className' => 'Subject',
			'foreignKey' => 'subject_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}
