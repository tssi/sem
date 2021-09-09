<?php
class ScheduleDetail extends AppModel {
	var $name = 'ScheduleDetail';
	var $recursive = 2;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Schedule' => array(
			'className' => 'Schedule',
			'foreignKey' => 'schedule_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Room' => array(
			'className' => 'Room',
			'foreignKey' => 'room_id',
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
		/* 'AssessmentSubject'=>array(
			'className' => 'AssessmentSubject',
			'foreignKey' => false,
			'conditions' => array('ScheduleDetail.schedule_id=AssessmentSubject.schedule_id,
									ScheduleDetail.subject_id=AssessmentSubject.subject_id,
									ScheduleDetail.section_id=AssessmentSubject.section_id'),
			'fields' => '',
			'order' => ''
		) */
		
	);
	
	
}
