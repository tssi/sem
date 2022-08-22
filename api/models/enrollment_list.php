<?php
class EnrollmentList extends AppModel {
	var $name = 'EnrollmentList';
	var $displayField = 'name';
	var $useTable = 'ledgers';
	var $useDbConfig = 'srp';
	var $order = 'transac_date ASC';
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
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
				'Student.last_name',
				'Student.first_name',
				'Student.middle_name',
			),
			'order' => ''
		),
	);
	
	/* function beforeFind($queryData){
		if($conds=$queryData['conditions']){
			$cond = array('EnrollmentList.ref_no NOT LIKE'=>'XOR%');
			array_push($conds,$cond);
			//pr($conds); exit();
			$queryData['conditions'] = $conds;
		}
		//pr($queryData); exit();
		return $queryData;
	}  */
}
