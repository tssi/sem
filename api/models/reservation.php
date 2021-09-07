<?php
class Reservation extends AppModel {
	var $name = 'Reservation';
	var $displayField = 'name';
	var $recursive = 2;
	var $cacheExpires = '+1 day';
	var $usePaginationCache = true;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => array(
				'Student.id',
				'Student.sno',
				'Student.gender',
				'Student.short_name',
				'Student.full_name',
				'Student.class_name',
				'Student.status',
				'Student.year_level_id',
				'Student.section_id',
			),
			'order' => ''
		),
		'Inquiry' => array(
			'className' => 'Inquiry',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	function beforeFind($queryData){
		//pr($queryData['conditions']); exit();
		if($conds=$queryData['conditions']){
			foreach($conds as $i=>$cond){
				if(!is_array($cond))
					break;
				$keys =  array_keys($cond);
				$search = 'Reservation.name LIKE';
				if(in_array($search,$keys)){
					$name = array_values($cond);
					//pr($name[0]);
					$students = $this->Student->findByName($name[0]);
					$inquiries = $this->Inquiry->findByName($name[0]);
					$res = [];
					foreach($inquiries as $i){
						array_push($res,$i['Inquiry']['id']);
					}
					foreach($students as $i=>$s){
						array_push($res,$i);
					}
					unset($conds['OR']);
					$cond = array('Reservation.account_id'=>$res);
					array_push($conds,$cond);
					//pr($students); exit();
					continue;
				}
				$conds[$i]=$cond;
			}
			//pr($conds); exit();
			$queryData['conditions']=$conds;
		}

		return $queryData;
	}

	
	function getRecords($id,$esp){
		$resConfig = array(
					'conditions'=>array(
							array('Reservation.account_id'=>$id),
							array('Reservation.esp'=>$esp)
						),
					'recursive'=>0,
					'fields'=>array(),
					'order'=>'Reservation.ref_no',
					'limit'=>999,
			);

		$this->recursive=0;
		$res = $this->paginate($resConfig['conditions'],$resConfig['fields'],$resConfig['order'],$resConfig['limit']);
		return $res;
	}
	
}
