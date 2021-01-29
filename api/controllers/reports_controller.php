<?php
class ReportsController extends AppController{
	var $name = 'Reports';
	var $uses = null;

	function student_registration_form(){
		$data = array();
		$this->set(compact('data'));
	}
	
}