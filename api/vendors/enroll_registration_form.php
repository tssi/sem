<?php
require('student_registration_form.php');
class EnrollRegistrationForm extends StudentRegistrationForm{
	protected static $_width = 8.5;
	protected static $_height = 14;
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
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 0,
			'width'=> EnrollRegistrationForm::$_width,
			'height'=>EnrollRegistrationForm::$_height,
			'cols'=> 38,
			'rows'=> 12,	
		);
		$this->section($metrics);
		$this->DrawBox(0,0,$metrics['cols'],$metrics['rows']/2,'D');
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
		if(isset($data['offsetY']))
			$metrics['base_y'] +=$data['offsetY'];

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

		// Student Info
		$SID 	= $data['sno'];
		$LRN 	= $data['lrn']?$data['lrn']:'N/A';
		$NAME 	= $data['print_name'];
		$LVL 	= strtoupper($complete['Section']['YearLevel']['description']);
		$DOB 	= strtoupper(date("M d, Y", strtotime($data['birthday'])));
		$SEX 	= $data['gender']=='M'?'MALE':'FEMALE';
		$FTHR 	= $data['Household']['father_name'];
		$MTHR 	= $data['Household']['mother_name'];
		$ADDR 	= $data['Household']['address'];
		$CNO 	= $data['Household']['mobile_number'];
		$DTM 	= strtoupper(date("M d, Y h:i A"));
		$TYPE 	= 'N/A';
		switch($data['Account']['subsidy_status']){
			case 'DSESC': $TYPE ='ESC'; break;
		}
		$utf8Vars = array('NAME','FTHR','MTHR','ADDR');
		foreach($utf8Vars as $var){
			$$var =  utf8_decode(mb_strtoupper($$var));
		}
		$this->leftText($COL_1,$y,$SID,'','');
		$this->leftText($COL_2,$y++,$LVL,'','');


		$this->leftText($COL_1,$y,$NAME,'','');
		$this->leftText($COL_2,$y,$DOB,'','');
		$this->leftText($COL_3,$y++,$SEX,'','');

		$this->leftText($COL_1,$y,$LRN,'','');
		$this->leftText($COL_3,$y++,$TYPE,'','');

		$this->leftText($COL_1,$y++,$ADDR,'','');
		

		$this->leftText($COL_1,$y,$FTHR,'','');
		$this->leftText($COL_2,$y++,$MTHR,'','');

		$this->leftText($COL_1,$y,$CNO,'','');
		$this->leftText($COL_2,$y,$DTM,'','');
		/*
		
		$this->leftText(20.5,$y++,$complete['Section']['YearLevel']['name'],'','');
		$this->leftText(5.5,$y,$data['print_name'],'','');

		$this->leftText(29,$y,date("M d,Y h:i:s A"),'','');
		*/
		
	}

	function data($data){
		$data['isRegForm'] = true;
		if(!isset($data['offsetY']))
			$data['offsetY'] = 0.6;
		$data['offsetX'] = 0;
		parent::data($data);
		$data['offsetX'] = 2;
		$this->payment_sched($data,0);
		$this->foot_notes($data,0);
	}
	function foot_notes($data,$end){
		$metrics =$this->setUpMetrics($data);

		$this->GRID['font_size']=7;

		//NOTE
		$y=19;
		$this->wrapText(7,$y,'IMPORTANT: '.$data['Important'],27);
		$this->SetFillColor(255,255,255);
		$this->DrawBox(7,$y,4,1.2,'F');
		$this->leftText(7.25,$y+0.75,'IMPORTANT:', '','b');

		$this->leftText(7.25,29,'CONFORME:', '','b');
		$this->DrawLine(31,'h',array(7.25,13.5));
		$this->centerText(7.25,32,'Signature Over Printed Name', 13.5,'');
		
		
		
		$AID = $data['Assessment']['id'];
		$URL = 'https://lsei.tssi.one/sap';
		$student = $data['Assessment']['student_id'];
		$DATA =sprintf("%s?USER=%s",$URL,$student);

		App::import('Vendor','phpqrcode/qrlib');
		App::import('Model','Record');
		
		$fileName = 'QR-'.$AID.'.png';
		
		$Record =  new Record();

		$fullPath = $Record->registerFile($fileName,$student,'qr',$DATA);
		// Check if file is the same skip generation
		if(!isset($fullPath['duplicate']))
			QRcode::png($DATA,$fullPath);
		else
			$fullPath =  $fullPath['path'];

		$offsetX = -11.25;
		$offsetY = -1;
		$SY = (int)$data['Assessment']['esp'].'';
		$MILL = sprintf('%s  %s',$SY[0],$SY[1]);
		$DECA = sprintf('%s  %s',$SY[2],$SY[3]);
		
		$this->DrawImage(0+$offsetX ,26+$offsetY,1.1,1.1,$fullPath);
		$this->GRID['font_size']=8;
		$this->leftText(-0.5+$offsetX ,27.25+$offsetY,$MILL,12,'b');
		$this->leftText(-0.5+$offsetX ,28+$offsetY,$DECA,12,'b');
		$this->GRID['font_size']=7.5;
		$this->RotateText(0.5+$offsetX ,32.5+$offsetY,'PWRD 12346',90);
		$this->RotateText(-0.25+$offsetX ,32.5+$offsetY,'USER 12346',90);

		$this->leftText(6.5+$offsetX ,30.5+$offsetY,"PARENT/STUDENT PORTAL",12,'');
		$this->leftText(6.5+$offsetX ,31.5+$offsetY,'SCAN CODE OR GO TO',12,'');
		$this->GRID['font_size']=8;
		$this->leftText(6.5+$offsetX ,32.5+$offsetY,$URL,12,'b');

		$this->GRID['font_size']=10;
		$COPY_OF = strtoupper(sprintf("%s'S COPY",$data['copyOf']));
		$this->leftText(6.5+$offsetX ,29+$offsetY,$COPY_OF, 0,'b');
		
		
	}
}