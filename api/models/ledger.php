<?php
class Ledger extends AppModel {
	var $name = 'Ledger';
	var $displayField = 'name';
	var $useDbConfig = 'srp';
	var $recursive = 2;
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	function beforeFind($queryData){
		//pr($queryData['conditions']); exit();
		if($conds=$queryData['conditions']){
			foreach($conds as $i=>$cond){
				if(!is_array($cond))
					break;
				$keys =  array_keys($cond);
				$search = 'Ledger.ref_no';
				$sy = 'Ledger.sy';
				//pr($cond[$search]); exit();
				if(in_array($search,$keys)){
					$preffix = $cond[$search];
					$ref = $preffix.$esp;
					//pr($cond); exit();
					unset($cond[$search]);
					$cond = array('Ledger.ref_no LIKE'=>$ref.'%');
					$conds[$i]=$cond;
				}
				if(in_array($sy,$keys)){
					$esp = $cond[$sy];
					$esp =  substr($esp.'', -2);
					unset($conds[$i]);
				}
				//pr($cond);
				
			}
			//pr($conds); exit();
			$queryData['conditions']=$conds;
		}
		
		return $queryData;
	}
	
}
