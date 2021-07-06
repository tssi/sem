<?php
class Enrollment extends AppModel {
	var $name = 'Enrollment';
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
	
	function beforeFind($queryData){
		if($conds=$queryData['conditions']){
			foreach($conds as $i=>$cond){
				if(is_array($cond)):
					$keys = array_keys($cond);
					$search = 'Enrollment.transac_date';
					if(in_array($search,$keys)){
						$value = $cond[$search];//
						unset($cond[$search]);
					}
				endif;
				$conds[$i]=$cond;
				
			}
			//pr($conds); exit();
			$queryData['conditions'] = $conds;
		}
		//pr($queryData); exit();
		return $queryData;
	}
}
