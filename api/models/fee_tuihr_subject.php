<?php
class FeeTuihrSubject extends AppModel {
	var $name = 'FeeTuihrSubject';
	var $displayField = 'name';
	var $recursive = 2;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Subject' => array(
			'className' => 'Subject',
			'foreignKey' => 'subject_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


}
