<?php
class Tuition extends AppModel {
	var $name = 'Tuition';
	var $displayField = 'name';
	var $recursive = 2;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'YearLevel' => array(
			'className' => 'YearLevel',
			'foreignKey' => 'year_level_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'FeeBreakdown' => array(
			'className' => 'FeeBreakdown',
			'foreignKey' => 'tuition_id',
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
		'PaymentScheme' => array(
			'className' => 'PaymentScheme',
			'foreignKey' => 'tuition_id',
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
		'Discount' => array(
			'className' => 'Discount',
			'foreignKey' => 'tuition_id',
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
	
	function getTuiDetail($sy,$yl){
		$tuitionObj = array('assessment_total'=>0);
		$cond = array('Tuition.sy'=>$sy,'Tuition.year_level_id'=>$yl);
		$this->recursive = 0;
		$tui = $this->find('first',array('conditions'=>$cond));
		if($tui)
			$tuitionObj = $tui['Tuition'];
		return $tuitionObj;
	}

}
