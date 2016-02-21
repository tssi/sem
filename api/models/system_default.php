<?php
class SystemDefault extends AppModel {
	var $name = 'SystemDefault';
	function afterFind($results){
		if(isset($results[0]))
			if(isset($results[0]['SystemDefault'])){
				$_result = array();
				foreach($results as $result){
					$value = json_decode($result['SystemDefault']['value'],true);
					if(json_last_error()==JSON_ERROR_NONE)
						$_result[$result['SystemDefault']['key']] = $value;
					else
						$_result[$result['SystemDefault']['key']] = $result['SystemDefault']['value'];
					
					if(isset($_result['START_SY']) && isset($_result['ACTIVE_SY']) && !isset($_result['SCHOOL_YEARS'])){
						$school_years = array();
						for($sy = $_result['START_SY'];$sy<=$_result['ACTIVE_SY'];$sy++){
							$school_year = array(
										'id'=>$sy,
										'label'=>$sy.'-'.($sy+1),
										'code'=>substr($sy,-2),
							);
							array_push($school_years,$school_year);
						}
						$_result['SCHOOL_YEARS'] = $school_years;
					}
				}
				
				$results = array(array('SystemDefault'=>$_result));
			}
		return $results;
	}
}
