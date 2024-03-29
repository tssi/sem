<?php
class AssessmentSubject extends AppModel {
	var $name = 'AssessmentSubject';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Assessment' => array(
			'className' => 'Assessment',
			'foreignKey' => 'assessment_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Subject' => array(
			'className' => 'Subject',
			'foreignKey' => 'subject_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'section_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Schedule' => array(
			'className' => 'Schedule',
			'foreignKey' => 'schedule_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
		
	);
	
	 var $hasMany = array(
	 	'ScheduleDetail'=>array(
	 		'className'=>'ScheduleDetail',
	 		'foreignKey'=>false,
	 		'dependent' => false,
	 		'finderQuery'=>'SELECT ScheduleDetail.* from schedule_details as ScheduleDetail
	 			INNER JOIN assessment_subjects as AssessmentSubject ON (
	 			ScheduleDetail.subject_id = AssessmentSubject.subject_id AND
	 			ScheduleDetail.schedule_id = AssessmentSubject.schedule_id
	 		)
	 		 WHERE AssessmentSubject.id = {$__cakeID__$}
	 		 ORDER BY ScheduleDetail.start_time
	 		 ',
	 	)
	 );
	

}
