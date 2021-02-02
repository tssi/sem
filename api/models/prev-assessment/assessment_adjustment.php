<?php
class AssessmentAdjustment extends AppModel {
	var $name = 'AssessmentAdjustment';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Assessment' => array(
			'className' => 'Assessment',
			'foreignKey' => 'assessment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
