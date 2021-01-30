<?php
class CurriculumDetail extends AppModel {
	var $name = 'CurriculumDetail';
	
	var $useDbConfig = 'ser';
	var $recursive = 0;
	var $usePaginationCache = true;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Curriculum' => array(
			'className' => 'Curriculum',
			'foreignKey' => 'curriculum_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'YearLevel' => array(
			'className' => 'YearLevel',
			'foreignKey' => 'year_level_id',
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
		),
	);
	
	
	
}
