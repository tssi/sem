<?php
class ReportsController extends AppController{
	var $name = 'Reports';
	var $uses = array('Assessment','Student');

	function student_registration_form(){
	
		$this->Assessment->recursive=2;
		$data = $this->Assessment->findById($_POST['AssessmentId']);
		//pr($data);exit;
		$this->set(compact('data'));
	}
	
}