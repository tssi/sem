<?php
class Guardian extends AppModel {
	var $name = 'Guardian';
	var $useDbConfig = 'ser';
	var $consumableFields =  array('id','first_name','middle_name','last_name','full_name','user_id');
	var $virtualFields = array(
				'full_name'=>"CONCAT( Guardian.first_name,' ',COALESCE(Guardian.middle_name,''),' ',Guardian.last_name)"
				);
	var $belongsTo = array(
		'UserGuardian' => array(
			'className' => 'UserGuardian',
			'foreignKey' => false,
			'dependent' => false,
			'conditions' => array('UserGuardian.username =  Guardian.user_id'),
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
		'HouseholdMember' => array(
			'className' => 'HouseholdMember',
			'foreignKey' => 'id',
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

	function createUser($gId){
		$GUID = $this->generateGUID();
		$SPL =  array('%','#','?','&','@');
		$PWD  =  strtoupper(substr(md5($GUID),0,3)).$SPL[$gId%5].substr(md5($gId),0,4);
		$USG = array(
				'UserGuardian'=>array(
					'user_type_id'=>'parnt',
					'username'=>$GUID,
					'plain_password'=>$PWD,
					'password'=>AuthComponent::password($PWD),
					'status'=>'ACTIV',
				)
		);

		$GRD = array(
			'id'=>$gId,
			'user_id'=>$GUID
		);
		
		// Attach username to Guardian.user_id
		$this->save($GRD);

		// Create UserGuardian
		$this->UserGuardian->create();
		$this->UserGuardian->save($USG);
		return $GRD;
	}

	function generateGUID(){
		// Use master config for the prefix
		$prefix = 'LSF';
		$length = 4;
		$isTaken = false;
		$GUID = null;
		do{
			$min = pow(10, $length - 1) ;
			$max = pow(10, $length) - 1;
			$GUID =  $this->luhnify(mt_rand($min, $max));
			$GUID = $prefix.$GUID;
			$isTaken = $this->findByUserId($GUID);
		}while($isTaken);
		return $GUID;
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
