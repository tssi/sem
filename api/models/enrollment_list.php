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
			'dependent' => false,
			'conditions' =>'',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
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
