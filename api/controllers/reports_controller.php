<?php
class ReportsController extends AppController{
	var $name = 'Reports';
	var $uses = array('Assessment','Student');

	function student_registration_form(){
		//$this->Assessment->bindModel(array('belongsTo' => array('Student','Inquiry')));
		$this->Assessment->recursive=2;
		$data = $this->Assessment->findById(4);
		//pr($data);exit;
		$this->set(compact('data'));
	}
	
}