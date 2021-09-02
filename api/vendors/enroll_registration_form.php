<?php
require('student_registration_form.php');
class EnrollRegistrationForm extends StudentRegistrationForm{
	protected static $_width = 8.5;
	protected static $_height = 13;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
	protected static $curr_page = 1;
	protected static $page_count;
	protected static $ctr = 1.8;
	protected static $grand_total = 0;
	
	function EnrollRegistrationForm(){
		$this->showLines = !true;
		$this->FPDF(EnrollRegistrationForm::$_orient, EnrollRegistrationForm::$_unit,array(EnrollRegistrationForm::$_width,EnrollRegistrationForm::$_height));
		$this->createSheet();
	}

	function hdr($data,$ass,$complete){
		
		//$this->showLines = true;
		$metrics = array(
			'base_x'=> 0.5,
			'base_y'=> 0.25,
			'width'=> 7.5,
			'height'=> 0.5,
			'cols'=> 38,
			'rows'=> 4,	
		);
		$this->section($metrics);
		$SCHOOL_ADDR =  'A. Bonifacio St. Canlalay, City of Biñan, Laguna';
		$SCHOOL_TELNO =  '(049) 511-4328';
		$SCHOOL_ID =  '424528';
		$SCHOOL_YR = intval($ass['esp']);

		$ADDR =  sprintf("%s",utf8_decode($SCHOOL_ADDR));
		$TELNO =  sprintf("Tel.No. %s",$SCHOOL_TELNO);
		$SCHID =  sprintf("School ID: %s",$SCHOOL_ID);
		$SCHID =  sprintf("School ID: %s",$SCHOOL_ID);
		$SCH_DURA =  sprintf("ONE YEAR DURATION SCHOOL YEAR %d - %d",$SCHOOL_YR, $SCHOOL_YR-1);
		$BAR_WIDTH =  27;
		
		$y=1;
		$this->DrawImage(4,-0.8,0.7,0.7,__DIR__."/images/logo.png");
		
		$this->GRID['font_size']=10;
		//$this->centerText(8,$y++,'LAKE SHORE EDUCATIONAL INSTITUTION',$BAR_WIDTH,'b');
		$this->DrawImage(14,-0.6,2.85,0.25,__DIR__."/images/lsei_wordmark.png");
		
		$y=2.5;
		$this->GRID['font_size']=7.5;
		$this->leftText(9,$y,$ADDR,'','');
		$this->leftText(22,$y,$TELNO,'','');
		$this->leftText(29,$y,$SCHID,'','');
		$this->DrawLine($y+0.5,'h',array(8,$BAR_WIDTH));
		$y=4.25;
		$this->GRID['font_size']=9.5;
		$this->centerText(8,$y,'CERTIFICATE OF REGISTRATION',$BAR_WIDTH,'b');
		$this->GRID['font_size']=8;
		$this->centerText(8,$y+1,$SCH_DURA ,$BAR_WIDTH,'');

		$BOX_Y =  $y =  7;
		$COL_1 =  5.5;
		$COL_2 =  22;
		$COL_3 =  34;
		$this->rightText($COL_1,$y,'STUDENT ID:','','b');
		$this->rightText($COL_2,$y++,'LEVEL/COURSE:','','b');
		
		$this->rightText($COL_1,$y,'NAME:','','b');
		$this->rightText($COL_2,$y,'DATE OF BIRTH:','','b');
		$this->rightText($COL_3,$y++,'GENDER:','','b');
		
		$this->rightText($COL_1,$y,'LRN:','','b');
		$this->rightText($COL_3,$y++,'STUDENT TYPE:','','b');

		$this->rightText($COL_1,$y++,'ADDRESS:','','b');

		$this->rightText($COL_1,$y,"FATHER'S NAME:",'','b');
		$this->rightText($COL_2,$y++,"MOTHER'S NAME:",'','b');

		$this->rightText($COL_1,$y,"CONTACT NO:",'','b');
		$this->rightText($COL_2,$y++,'DATE/TIME:','','b');

		$BOX_H = $y-$BOX_Y +0.5;
		$y=$BOX_Y;
		$this->drawBox(0,$y-1,38,$BOX_H);

		$COL_1 +=0.5;
		$COL_2 +=0.5;
		$COL_3 +=0.5;
		
		$this->leftText($COL_1,$y,'STUDENT ID:','','');
		$this->leftText($COL_2,$y++,'LEVEL/COURSE:','','');


		$this->leftText($COL_1,$y,'NAME:','','');
		$this->leftText($COL_2,$y,'DATE OF BIRTH:','','');
		$this->leftText($COL_3,$y++,'FEMALE','','');

		$this->leftText($COL_1,$y,'LRN:','','');
		$this->leftText($COL_3,$y++,'ESC:','','');

		$this->leftText($COL_1,$y++,'ADDRESS:','','');
		

		$this->leftText($COL_1,$y,"FATHER'S NAME:",'','');
		$this->leftText($COL_2,$y++,"MOTHER'S NAME:",'','');

		$this->leftText($COL_1,$y,"CONTACT NO:",'','');
		/*
		
		$this->leftText(20.5,$y++,$complete['Section']['YearLevel']['name'],'','');
		$this->leftText(5.5,$y,$data['print_name'],'','');

		$this->leftText(29,$y,date("M d,Y h:i:s A"),'','');
		*/
		
	}

	function data($data){

	}
}