<?php
class UserGuardian extends AppModel {
	var $name = 'UserGuardian';
	var $useDbConfig = 'ser';
	var $useTable = 'user_students';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasOne = array(
		'Guardian' => array(
			'className' => 'Guardian',
			'foreignKey' => false,
			'conditions' =>  array('UserGuardian.username =  Guardian.user_id'),
			'fields' => '',
			'order' => ''
		),
	);
}
