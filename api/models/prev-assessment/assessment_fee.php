<?php
class AssessmentFee extends AppModel {
	var $name = 'AssessmentFee';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Assessment' => array(
			'className' => 'Assessment',
			'foreignKey' => 'assessment_id',
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
