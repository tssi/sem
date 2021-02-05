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
	
	function hdr($data){
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
		$this->leftText(15,$y,'LEVEL/COURSE:','','b');
		$this->leftText(25,$y++,'DATE/TIME:','','b');
		$this->rightText(5,$y++,'NAME:','','b');
		$y=6;
		$this->leftText(5.5,$y,$data['id'],'','');
		$this->leftText(20.5,$y++,$data['year_level_id'].'/'.$data['section_id'],'','');
		$this->leftText(5.5,$y++,$data['print_name'],'','');
		$this->drawBox(0,5,38,2.5);
	}
	
	function newstudent($data){
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
		//pr($data);exit;
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
		$this->leftText(15,$y,'LEVEL/COURSE:','','b');
		$this->leftText(25,$y++,'DATE/TIME:','','b');
		$this->rightText(5,$y++,'NAME:','','b');
		$y=6;
		$this->leftText(5.5,$y,$data['student_id'],'','');
		$this->leftText(20.5,$y,'','','');
		$this->leftText(29,$y++,date("M d,Y h:i:s A"),'','');
		$this->leftText(5.5,$y++,$data['last_name'].','.$data['first_name'].' '.$data['middle_name'],'','');
		$this->drawBox(0,5,38,2.5);
	}
	
	function data($data){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.5,
			'base_y'=> 1.4,
			'width'=> 5.5,
			'height'=> 0.6,
			'cols'=> 33,
			'rows'=> 4,	
		);
		$this->section($metrics);
		$y=0;
		$this->leftText(4,$y,'SUBJECTS',10,'b');
		$this->centerText(15,$y,'UNITS',2,'b');
		$this->leftText(17.2,$y,'SECTION','','b');
		$this->centerText(22,$y,'DAY',2,'b');
		$this->centerText(24,$y,'TIME',4,'b');
		$this->leftText(28.2,$y++,'TEACHER','','b');
		//pr($data);exit;

		//ASSESSMENT
		$totalunits=0;
		foreach($data['AssessmentSubject'] as $d){
			$this->leftText(0.2,$y,$d['subject_id'],'','');
			$this->leftText(4.2,$y,$d['Subject']['name'],'','');
			$this->centerText(15,$y,$d['Subject']['units'],2,'');
			$this->leftText(17.2,$y,isset($d['Section']['name']),'','');
			$this->centerText(22,$y,'--',2,'');
			$this->centerText(24,$y,'--',4,'');
			$this->leftText(28.2,$y,'--','','');
			$totalunits+=$d['Subject']['units'];
			$y++;
		}
		$this->drawLine($y-0.6,'h');
		$this->leftText(0.2,$y,'Total No. of Subject: '.count($data['AssessmentSubject']),'','b');
		$this->centerText(15,$y,number_format($totalunits,2),2,'b');
		$end = $y+3;
		
		//FEE BREAKDOWN
		$y=$end;
		$total=0;
		$this->leftText(0.2,$y++,'FEE BREAKDOWN','','b');
		foreach($data['AssessmentFee'] as $d){
			$this->leftText(0.2,$y,$d['Fee']['name'],'','');
			$this->rightText(15,$y,number_format($d['due_amount'],2),'','');
			$total+=$d['due_amount'];
			$y++;
		}
		$this->drawLine($y-0.6,'h',array(0,16));
		$this->leftText(0.2,$y,'Total','','b');
		$this->rightText(15,$y,number_format($total,2),'','b');
		
		//PAYMENT SCHED
		$y=$end;
		$totaldue=0;
		$this->leftText(22.2,$y++,'PAYMENT SCHEDULE','','b');
		foreach($data['AssessmentPaysched'] as $d){
			$this->leftText(22.2,$y,date("M d, Y", strtotime($d['due_date'])),'','');
			if($d['due_amount']) $this->rightText(30,$y,number_format($d['due_amount'],2),3,'');
			else $this->rightText(30,$y,'--',3,'');
			$totaldue+=$d['due_amount'];
			$y++;
		}
	
		$this->drawLine($y-0.6,'h',array(22,11));
		$this->rightText(30,$y,number_format($totaldue,2),3,'b');
		
		
		//NOTE
		$y=34;
		$this->leftText(0,$y,'IMPORTANT:',10,'b');
	}	
}
?>
	