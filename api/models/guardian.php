<?php
class Guardian extends AppModel {
	var $name = 'Guardian';
	var $useDbConfig = 'ser';
	var $consumableFields =  array('id','first_name','middle_name','last_name','full_name');
	var $virtualFields = array(
				'full_name'=>"CONCAT( Guardian.first_name,' ',COALESCE(Guardian.middle_name,''),' ',Guardian.last_name)"
				);
	var $hasMany = array(
		'HouseholdMember' => array(
			'className' => 'HouseholdMember',
			'foreignKey' => 'id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
}
