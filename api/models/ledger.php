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
	function getAccountId($ref_no, $trnx_id){
		$AID = null;
		$cond =  array('ref_no'=>$ref_no , 'transaction_type_id'=>$trnx_id);
		$LDG = $this->find('first',array('conditions'=>$cond));
		if($LDG)
			$AID = $LDG['Ledger']['account_id'];
		return $AID;

	}
}
