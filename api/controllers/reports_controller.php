<?php
class ReportsController extends AppController{
	var $name = 'Reports';
	var $uses = array('Assessment');

	function student_registration_form(){
		$assessment = $this->Assessment->find('first');
		$data = array();
		$this->set(compact('data'));
	}
	
}