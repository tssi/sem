<?php
class ReportsController extends AppController{
	var $name = 'Reports';
	var $uses = array('Assessment','Student');

	function student_registration_form(){
		$this->Assessment->bindModel(array('belongsTo' => array('Student')));
		$data = $this->Assessment->find('first');
		//pr($data);exit;
		$this->set(compact('data'));
	}
	
}