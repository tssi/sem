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

	function hasHousehold($student){
		$HOM = $this->HouseholdMember->findByEntityId($student);
		$hasHOM = isset($HOM['HouseholdMember']);
		return $hasHOM;
	}

	function initHome($home){
		$HID = $this->generateHONO();
		$home['id'] =  $HID;
		$this->save($home);
		$SID = $home['student'];
		$GRD = $home['guardian'];
		$this->HouseholdMember->Guardian->save($GRD);
		$GID = $this->HouseholdMember->Guardian->id;
		$members = array();
		$members[] = array('household_id'=>$HID,'type'=>'STU','entity_id'=>$SID);
		$members[] = array('household_id'=>$HID,'type'=>'GRD','entity_id'=>$GID);
		$this->HouseholdMember->saveAll($members);
		$HOM = $this->findById($HID);
		return $HOM;
	}

	function generateHONO(){
		$prefix = 44;
		$length = 5;
		$isTaken = false;
		do{
			$min = pow(10, $length - 1) ;
			$max = pow(10, $length) - 1;
			$HONO =  $this->luhnify($prefix.mt_rand($min, $max));  
			$isTaken = $this->findById($HONO);
		}while($isTaken);
		return $HONO;
	}

	protected function luhnify($number) {
	    $sum = 0;               // Luhn checksum w/o last digit
	    $even = true;           // Start with an even digit
	    $n = $number;

	    // Lookup table for the digitsums of 2*$i
	    $evendig = array(0, 2, 4, 6, 8, 1, 3, 5, 7, 9);

	    while ($n > 0) {
	        $d = $n % 10;
	        $sum += ($even) ? $evendig[$d] : $d;

	        $even = !$even;
	        $n = ($n - $d) / 10;
	    }

	    $sum = 9*$sum % 10;

	    return 10 * $number + $sum; 
	}

}
