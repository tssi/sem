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
				$sy = 'Ledger.sy';
				$search = 'Ledger.ref_no';
				
				//pr($cond[$search]); exit();
				
				
				if(in_array($sy,$keys)){
					$esp = $cond[$sy];
					$esp =  substr($esp.'', -2);
					//pr($esp);
					unset($conds[$i]);
				}
				if(in_array($search,$keys)){
					$preffix = $cond[$search];
					$ref = $preffix;
					//pr($ref); exit();
					unset($cond[$search]);
					unset($conds[$i]);
				}
				//pr($cond);
				
			}
			if(isset($esp)){
				$cond = array('Ledger.ref_no LIKE'=>$ref.$esp.'%');
				array_push($conds,$cond);
			}
			//pr($conds); exit();
			$queryData['conditions']=$conds;
		}
		
		return $queryData;
	}
	
}
