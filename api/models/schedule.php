<?php
class Schedule extends AppModel {
	var $name = 'Schedule';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'section_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'ScheduleDetail' => array(
			'className' => 'ScheduleDetail',
			'foreignKey' => 'schedule_id',
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
	function beforeFind($queryData){
		if($conds=$queryData['conditions']){
			foreach($conds as $i=>$cond){
				$keys =  array_keys($cond);
				$search = 'Schedule.program_id';
				if(in_array($search,$keys)){
					$value = $cond[$search];
					$sections = $this->Section->findByProgramId($value);
					$section_ids = array_keys($sections);
					unset($cond[$search]);
					$cond['Schedule.section_id']=$section_ids;
				}
				$conds[$i]=$cond;
			}
			
			$queryData['conditions']=$conds;
		}
		return $queryData;
	}
}
