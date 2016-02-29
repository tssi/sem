<?php
class Section extends AppModel {
	var $name = 'Section';
	var $useDbConfig = 'sas';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
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
		)
	);
	function afterFind($results){
		if(isset($results[0]['Section'])){
			//pr($results);
			$BillingPeriod  = &ClassRegistry::init('BillingPeriod');
			foreach($results as $index=>$result){
				if(isset($result['Program']['name']))
					$results[$index]['Section']['program']=$result['Program']['name'];
				if(isset($result['YearLevel']['name']))
			$results[$index]['Section']['year_level']=$result['YearLevel']['name'];
			
			}
		}
		return $results;
	}
}
