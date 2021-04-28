<?php
class Inquiry extends AppModel {
	var $name = 'Inquiry';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'YearLevel' => array(
			'className' => 'YearLevel',
			'foreignKey' => 'year_level_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Program' => array(
			'className' => 'Program',
			'foreignKey' => 'program_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'year_level_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		/* 'Reservation' => array(
			'className' => 'Reservation',
			'foreignKey' => 'account_id',
			'fields' => '',
			'order' => ''
		), */
	);
	
	function generateIID(){
		$ID = 0;
		$cond =  array('Inquiry.id LIKE'=>'LSN%');
		$this->recursive=-1;
		$inqObj = $this->find('first',array('conditions'=>$cond,'order'=>array('id'=>'desc')));

		if($inqObj)
			$ID =  (int)(str_replace('LSN', '', $inqObj['Inquiry']['id']));
		$IID = 'LSN'.str_pad($ID+1, 5, 0, STR_PAD_LEFT);
		
		return $IID;
	}

}
