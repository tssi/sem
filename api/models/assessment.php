<?php
class Assessment extends AppModel {
	var $name = 'Assessment';
	var $displayField = 'name';
	var $cacheExpires = '+1 day';
	var $usePaginationCache = true;
	var $actsAs = array('Containable');
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'student_id',
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
		'Inquiry' => array(
			'className' => 'Inquiry',
			'foreignKey' => false,
			'dependent' => false,
			'conditions' => array('Inquiry.id=Assessment.student_id'),
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
	);
	var $hasMany = array(
		'AssessmentPaysched' => array(
			'className' => 'AssessmentPaysched',
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
		'AssessmentFee' => array(
			'className' => 'AssessmentFee',
			'foreignKey' => 'assessment_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'order',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'AssessmentSubject' => array(
			'className' => 'AssessmentSubject',
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
		
	);
	function getEnrolled($sy,$sectId){
		$ids = array();
		$cond =  array('Assessment.esp'=>$sy,
						'Assessment.section_id'=>$sectId,
						'Assessment.status'=>'NROLD');
		
		$cont = array('Student'=>array('id','class_name','gender'),'Inquiry'=>array('id','full_name','gender'));

		
		$ass = $this->find('all',array('conditions'=>$cond,'contain'=>$cont));
		$sortAss = array('M'=>array(),'F'=>array());
		foreach($ass as $A){
			if($A['Inquiry']['id']){
				$sex = $A['Inquiry']['gender'];
				$aid = $A['Assessment']['id'];
				$sortAss[$sex][$aid] =  $A['Inquiry']['full_name'];
 			}else if($A['Student']['id']){
				$sex = $A['Student']['gender'];
				$aid = $A['Assessment']['id'];
				$sortAss[$sex][$aid] =  $A['Student']['class_name'];
 			}
		}
		asort($sortAss['M']);
		asort($sortAss['F']);
		$ids = array_merge(array_keys($sortAss['M']),array_keys($sortAss['F']));
		return $ids;

	}
	function generateAID(){
		$ID = 0;
		$cond =  array('Assessment.id LIKE'=>'LSA%');
		$this->recursive=-1;
		$inqObj = $this->find('first',array('conditions'=>$cond,'order'=>array('id'=>'desc')));

		if($inqObj)
			$ID =  (int)(str_replace('LSA', '', $inqObj['Assessment']['id']));
		$IID = 'LSA'.str_pad($ID+1, 5, 0, STR_PAD_LEFT);
		
		return $IID;
	}

}
