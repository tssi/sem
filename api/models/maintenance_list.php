<?php
class MaintenanceList extends AppModel {
	var $name = 'MaintenanceList';
	var $order = 'order';
	var $recursive = 0;
	var $cacheExpires = '+1 day';
	var $usePaginationCache = false;
	function afterFind($results){
		if(isset($results[0]['MaintenanceList'])){
			$maintenanceLists = $results;
			foreach( $maintenanceLists as $index=>$list){
				$path =  $list['MaintenanceList']['path'];
				switch($path){
					case 'modules':
						$path = 'master_modules';
					break;
					case 'educ_levels':
						$path = 'departments';
					break;
				}
				$maintenanceLists[$index]['MaintenanceList']['schema'] = $this->getSchema($path);
			}
			$results = $maintenanceLists;
		}
		return $results;		
	}
	function getSchema($modelName){
		$file = Inflector::singularize($modelName);
		$class = Inflector::classify($modelName);
		if(file_exists(APP.'models'.DS.$file.'.php')){
			App::import('Model',$class);
			$model = new $class();
			$schema = array();
			foreach($model->_schema as $column=>$value){
				$col = $value;
				$col['name']=$column;
				array_push($schema,$col);
			}
			return $schema;
		}else{
			return null;
		}
	}
}
