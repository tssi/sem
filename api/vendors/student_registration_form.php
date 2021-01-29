<?php
require('vendors/fpdf17/formsheet.php');
class StudentRegistrationForm extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 6.5;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
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
			'base_x'=> 0.25,
			'base_y'=> 0.25,
			'width'=> 6,
			'height'=> 0.5,
			'cols'=> 38,
			'rows'=> 4,	
		);
		$this->section($metrics);
		
		$y=1;
		$this->DrawImage(5,-0.8,0.7,0.7,__DIR__."/images/logo.png");
		$this->GRID['font_size']=10;
		$this->centerText(0,$y++,'LAKE SHORE EDUCATIONAL INSTITUTION',38,'b');
		$this->GRID['font_size']=7;
		$this->centerText(0,$y++,'BONIFACIO ST., CANLALAY, BINAN, LAGUNA',38,'');
		$this->centerText(0,$y++,'STUDENT REGISTRATION FORM',38,'b');
		$this->centerText(0,$y++,'ONE YEAR DURATION SCHOOL YEAR 2020-2021',38,'');
		$y=6;
		$this->rightText(5,$y,'STUDENT ID:','','b');
		$this->leftText(15,$y++,'LEVEL/COURSE:','','b');
		$this->rightText(5,$y++,'NAME:','','b');
		
		$y=6;
		$this->leftText(5.5,$y,rand(),'','');
		$this->leftText(20.5,$y++,'XXX','','');
		$this->leftText(5.5,$y++,'Juan Dela Cruz','','');
		$this->drawBox(0,5,38,2.5);
		
	
	}
	
	function data(){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.5,
			'base_y'=> 1.4,
			'width'=> 5.5,
			'height'=> 0.7,
			'cols'=> 33,
			'rows'=> 4,	
		);
		$this->section($metrics);
		$y=0;
		$this->leftText(3,$y,'SUBJECTS',10,'b');
		$this->centerText(13,$y,'UNITS',2,'b');
		$this->leftText(15.2,$y,'SECTION','','b');
		$this->centerText(20,$y,'DAY',2,'b');
		$this->centerText(22,$y,'TIME',4,'b');
		$this->leftText(26.2,$y++,'TEACHER','','b');
		

		$amount = '99,999.99';
		for($i=1;$i<10;$i++){
			$this->leftText(0.2,$y,'SUB'.$i,'','');
			$this->leftText(3.2,$y,'SUBJECT '.$i,'','');
			$this->centerText(13,$y,'1.0',2,'');
			$this->leftText(15.2,$y,'Section '.$i,'','');
			$int= mt_rand(1262055681,1272509157);
			$randomDate = date("D",$int);
			$randomTime = date("h:i A",$int);
			$this->centerText(20,$y,strtoupper($randomDate),2,'');
			$this->centerText(22,$y,strtoupper($randomTime),4,'');
			$this->leftText(26.2,$y,'Teacher '.$i,'','');
			$y++;
		}
		$this->drawLine($y-0.6,'h');
		$this->leftText(0.2,$y,'Total No. of Subject: 9','','b');
		$this->centerText(13,$y,'9.0',2,'b');
		$end = $y+3;
		
		//FEE BREAKDOWN
		$y=$end;
		$this->leftText(0.2,$y++,'FEE BREAKDOWN','','b');
		for($i=1;$i<10;$i++){
			$this->leftText(0.2,$y,'FEE '.$i,'','');
			$this->centerText(13,$y,$amount,2,'');
			$y++;
		}
		$this->drawLine($y-0.6,'h',array(0,16));
		$this->leftText(0.2,$y,'Total','','b');
		$this->centerText(13,$y,$amount,2,'b');
		
		//PAYMENT SCHED
		$y=$end;
		$this->leftText(22.2,$y++,'PAYMENT SCHEDULE','','b');
		for($i=1;$i<10;$i++){
			$int= mt_rand(1262055681,1272509157);
			$randomDate = date("M d,Y",$int);
			$this->leftText(22.2,$y,strtoupper($randomDate),'','');
			$this->rightText(30,$y,$amount,3,'');
			$y++;
		}
		$this->drawLine($y-0.6,'h',array(22,11));
		$this->rightText(30,$y,$amount,3,'b');
		
		
		//NOTE
		$y=34;
		$this->leftText(0,$y,'IMPORTANT:',10,'b');
	}	
}
?>
	