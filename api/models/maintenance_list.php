<?php
class MaintenanceList extends AppModel {
	var $name = 'MaintenanceList';
	function afterFind($results){
		if(isset($results[0]['MaintenanceList'])){
			$maintenanceLists = $results;
			foreach( $maintenanceLists as $index=>$list){
				$path =  $list['MaintenanceList']['path'];
				$file = Inflector::singularize($path);
				$class = Inflector::classify($path);
				if(file_exists(APP.'models'.DS.$file.'.php')){
					App::import('Model',$class);
					$model = new $class();
					$schema = array();
					foreach($model->_schema as $column=>$value){
						$col = $value;
						$col['name']=$column;
						array_push($schema,$col);
					}
					$maintenanceLists[$index]['MaintenanceList']['schema']=$schema;
				}else{
					$maintenanceLists[$index]['MaintenanceList']['schema'] = null;
				}
			}
			
			$results = $maintenanceLists;
		}
		return $results;		
	}
}
