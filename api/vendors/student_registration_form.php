<?php
require('vendors/fpdf17/formsheet.php');
class StudentRegistrationForm extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 11;
	protected static $_unit = 'in';
	protected static $_orient = 'L';	
	protected static $curr_page = 1;
	protected static $page_count;
	protected static $ctr = 1.8;
	protected static $grand_total = 0;
	
	function StudentRegistrationForm(){
		$this->showLines = !true;
		$this->FPDF(StudentRegistrationForm::$_orient, StudentRegistrationForm::$_unit,array(StudentRegistrationForm::$_width,StudentRegistrationForm::$_height));
		$this->createSheet();
	}
	
	function hdr(){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.5,
			'base_y'=> 0.25,
			'width'=> 10,
			'height'=> 0.7,
			'cols'=> 38,
			'rows'=> 4,	
		);
		$this->section($metrics);
		
		$y=1;
		$this->DrawImage(11,-0.7,0.7,0.7,__DIR__."/images/logo.png");
		$this->GRID['font_size']=11;
		$this->centerText(0,$y++,'Lake Shore Educational Institution',38,'');
		$this->GRID['font_size']=9;
		$this->centerText(0,$y++,'Daily Remittance Report',38,'');
		//$date = strtotime($date);
		//$this->centerText(0,$y++,'Date: '. date('M d, Y',$date),38,'');
	}
	
}
?>
	