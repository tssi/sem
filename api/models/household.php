<?php
class Household extends AppModel {
	var $name = 'Household';
	var $useDbConfig = 'ser';
	var $virtualFields = array(
				'address'=>"CONCAT( street,' ',barangay,' ',city,' ',province)"
				);
	// var $recursive = 2;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		
		'HouseholdMember' => array(
			'className' => 'HouseholdMember',
			'foreignKey' => 'household_id',
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
	function getInfo($student){
		$hhObj = array();
		$HOM = $this->HouseholdMember->findByEntityId($student);
		if($HOM['HouseholdMember']){
			$HID = $HOM['HouseholdMember']['household_id'];
			$HHL = $this->find('first',array('conditions'=>array('id'=>$HID)));
			$hhObj['id'] = $HHL['Household']['id'];
			$hhObj['address'] = $HHL['Household']['address'];
			$hhObj['email'] = $HHL['Household']['email'];
			$hhObj['mobile_number'] = $HHL['Household']['mobile_number'];
			$conds =  array('HouseholdMember.type'=>'GRD',
						'HouseholdMember.household_id'=>$HID);
			$GRD = $this->HouseholdMember->find('all',array('conditions'=>$conds));
			$members =  array();
			foreach ($GRD as $grd) {
				$g = $grd['Guardian'];
				$member =  array('name'=>$g['full_name'],'rel'=>$g['rel']);
				array_push($members,$member);
			}
			$hhObj['members']=$members;
		}
		return $hhObj;
	}

}
