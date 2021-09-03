<?php
class HouseholdMember extends AppModel {
	var $name = 'HouseholdMember';
	var $useDbConfig = 'ser';
	var $actsAs = array('Containable');
	var $recursive = 2;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Household' => array(
			'className' => 'Household',
			'foreignKey' => 'household_id',
			'conditions' => '',
			'fields' => array('id','street','barangay','city','province','email','mobile_number'),
			'order' => ''
		),
		'Guardian' => array(
			'className' => 'Guardian',
			'foreignKey' => 'entity_id',
			'conditions' => '',
			'fields' => array(),
			'order' => ''
		),
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'entity_id',
			'conditions' => '',
			'fields' => array('id','first_name','middle_name','last_name','year_level_id'),
			'order' => ''
		),
	);
	function beforeFind($queryData){
		if($conds=$queryData['conditions']){
			//pr($conds); exit();
			foreach($conds as $i=>$cond){
				if(is_array($cond)):
					$keys =  array_keys($cond);
					$search = 'HouseholdMember.student LIKE';
					if(in_array($search,$keys)){
						
						$value = $cond[$search];
						$student= $this->Student->findByName($value);
						$stud_ids = array_keys($student);
						unset($cond[$search]);
						unset($conds['OR']);
						$cond['HouseholdMember.entity_id'] = $stud_ids;
					}
				endif;
				$conds[$i]=$cond;
			}
			$queryData['conditions']=$conds;
		}
		return $queryData;
	}
	
}
