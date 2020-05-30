<?php
class CurriculumSection extends AppModel {
	var $name = 'CurriculumSection';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'section_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Curriculum' => array(
			'className' => 'Curriculum',
			'foreignKey' => 'curriculum_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
