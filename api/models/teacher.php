<?php
class Teacher extends AppModel {
	var $name = 'Teacher';
	var $useDbConfig = 'ser';
	
	var $hasMany = array(
		'AdvisorySection' => array(
			'className' => 'AdvisorySection',
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
