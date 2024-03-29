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
		//$this->DrawBox(0,0,$metrics['cols'],$metrics['rows']/2,'D');
	}

	function hdr($data,$ass,$complete){
		//pr($complete); exit();
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
		$SCHOOL_ID =  '424538';
		$SCHOOL_SM = intval(explode('.',$ass['esp'].'')[1]);
		
		
		$SCHOOL_YR = intval($ass['esp']);

		$isSH =  $data['year_level_id']=='GY' ||  $data['year_level_id']=='GZ';
		
		$ADDR =  sprintf("%s",utf8_decode($SCHOOL_ADDR));
		$TELNO =  sprintf("Tel.No. %s",$SCHOOL_TELNO);
		$SCHID =  sprintf("School ID: %s",$SCHOOL_ID);
		$SCHID =  sprintf("School ID: %s",$SCHOOL_ID);
		$SCH_DURA =  sprintf("SCHOOL YEAR %d - %d /  ",$SCHOOL_YR, $SCHOOL_YR+1);
		$is2ndSEM  = false;
		if($isSH):
			$is2ndSEM =  isset($complete['isSecondSem']);
			$SCH_DURA .=!$is2ndSEM?'1st Semester':'2nd Semester';
		else:
			$SCH_DURA .='FULL';
		endif;
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
		$this->rightText($COL_3,$y-1,'SECTION:','','b');
		$this->rightText($COL_3,$y++,'GENDER:','','b');
		
		$this->rightText($COL_1,$y,'LRN:','','b');
		if($data['Account']['subsidy_status']=='DSPUB')
			$this->rightText(32,$y++,'STUDENT TYPE:','','b');
		else
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
		if(!isset($data['sno'])){
			pr($data);exit;
		}
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
			case 'REGXX': $TYPE = 'REGULAR'; break;
			case 'DSPUB': $TYPE = 'PUBLIC COMPLETER'; break;
			case 'DSQVR': $TYPE = 'QVR'; break;
			case null: $TYPE = 'REGULAR'; break;
		}
		$utf8Vars = array('NAME','FTHR','MTHR','ADDR');
		foreach($utf8Vars as $var){
			$$var =  utf8_decode(mb_strtoupper($$var));
		}
		$this->leftText($COL_1,$y,$SID,'','');
		$this->leftText($COL_2,$y++,$LVL,'','');

		//pr($complete);
		$this->leftText($COL_1,$y,$NAME,'','');
		$this->leftText($COL_2,$y,$DOB,'','');
		$this->leftText($COL_3,$y-1,$complete['Section']['name'],'','');
		//pr($data); exit();
		if(!in_array($data['year_level_id'],array('G7','G8','G9','GX')))
			$this->leftText($COL_2+2.75,$y-1,'-'.$complete['Section']['Program']['name'],'','');
			
		$this->leftText($COL_3,$y++,$SEX,'','');

		$this->leftText($COL_1,$y,$LRN,'','');
		if($data['Account']['subsidy_status']=='DSPUB')
			$this->leftText(32.2,$y++,$TYPE,'','');
		else
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
		$isRegular  =  $data['Assessment']['account_details']!='Irregular';
		if(isset($data['isSecondSem'])&& $isRegular){
			$this->hardcode($data);
		}
		else{
			$this->payment_sched($data,0);
			$this->foot_notes($data,0);
		}
	}
	function foot_notes($data,$end){
		$metrics =$this->setUpMetrics($data);

		

		//NOTE
		$y=26;
		$this->GRID['font_size']=9;
		//$this->wrapText(7,$y-3,'Adviser: '.$data['Teacher'],27);
		$this->GRID['font_size']=7;
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
		$username = $password = '??';
		if(isset($data['Student']['Household']['username'])):
		$username = $data['Student']['Household']['username'];
		$password = $data['Student']['Household']['password'];
		endif;
		$DATA =sprintf("%s?USER=%s&PASS=%s",$URL,$username,$password);
		$USER = sprintf("U: %s",$username);
		$PASS = sprintf("P: %s",$password);
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
		
		//$this->DrawImage(0+$offsetX ,26+$offsetY,1.1,1.1,$fullPath);
		$this->GRID['font_size']=8;
		//$this->leftText(-0.5+$offsetX ,31.75+$offsetY,$MILL,12,'b');
		//$this->leftText(-0.5+$offsetX ,32.5+$offsetY,$DECA,12,'b');
		$this->GRID['font_size']=7.5;
		//$this->RotateText(0.5+$offsetX ,31+$offsetY,$PASS,90,'b');
		//$this->RotateText(-0.25+$offsetX ,31+$offsetY,$USER,90);

		//$this->leftText(6.5+$offsetX ,30.5+$offsetY-1.5,"PARENT/STUDENT PORTAL",12,'');
		//$this->leftText(6.5+$offsetX ,31.5+$offsetY-1.5,'SCAN CODE OR GO TO',12,'');
		$this->GRID['font_size']=8;
		//$this->leftText(6.5+$offsetX ,32.5+$offsetY-1,$URL,12,'b');
		$this->leftText($offsetX-1 ,32.5+$offsetY-1,'Visit us at: www.lsei.edu.ph',12,'b');
		$this->leftText($offsetX-1 ,32.5+$offsetY,'Email us at: registrar@lakeshore.edu.ph',12,'b');

		$this->GRID['font_size']=10;
		$COPY_OF = strtoupper(sprintf("%s'S COPY",$data['copyOf']));
		$this->leftText(25 ,32,$COPY_OF, 0,'b');
		
		
	}
	
	function hardcode($data){
		$this->GRID['font_size']=8;
		//$this->leftText(1,20.5,"I declare that all the information submitted to LSEI are true and correct. I shall abide by all existing rules and regulations ",12,'b');
		//$this->leftText(1,21.5,"of the school and those that are promulgated from time to time.",12,'b');
		//$this->leftText(2.5,26.5,"Student Signiture Over Printed Name",12,'b');
		/* $this->wrapText(7,20.5,'IMPORTANT: '.$data['Important'],35);
		$this->leftText(25.5,26.5,"Date",12,'b');
		$this->leftText(1,25.5,"_________________________________________",12,'b');
		$this->leftText(23,25.5,"____________________",12,'b'); */
		$this->wrapText(33.5,.5,"Fees for the Second semester are inclusive in the first semester assessment",12);
		$year =  ceil($data['Assessment']['esp']);
		$pay_calendar =array("2022"=>[1,5], "2023"=>[2,6]);

		$this->leftText(34,5,"Installment Payment Schedule:",12,'b');
		$month_start =  $pay_calendar[$year][0];
		$month_count =  $pay_calendar[$year][1];
		$moy=7;

		for($ctr=1,$mo=$month_start;$ctr<=$month_count;$ctr++,$mo++):
			$month =  date("F", strtotime("$year-$mo-15"));
			$this->leftText(34,$moy,"$month 15, $year",12,'');
			$moy+=1.5;
		endfor;
		/*$this->leftText(34,9,"February 15, $year",12,'b');
		$this->leftText(34,11,"March 15, $year",12,'b');
		$this->leftText(34,13,"April 15, $year",12,'b');
		$this->leftText(34,15,"May 1, $year",12,'b');*/
		
		
		$metrics =$this->setUpMetrics($data);

		$this->GRID['font_size']=7;

		//NOTE
		$y=20;
		$this->wrapText(17,$y,'IMPORTANT: '.$data['Important'],27);
		$this->SetFillColor(255,255,255);
		$this->DrawBox(7,$y,4,1.2,'F');

		$this->leftText(7.25,29,'CONFORME:', '','b');
		$this->DrawLine(31,'h',array(7.25,13.5));
		$this->centerText(7.25,32,'Signature Over Printed Name', 13.5,'');
		$this->DrawLine(31,'h',array(25,13.5));
		$this->centerText(25,32,'Date', 13.5,'');
		
		$AID = $data['Assessment']['id'];
		$URL = 'https://lsei.tssi.one/sap';
		$student = $data['Assessment']['student_id'];
		$username = $password = '??';
		if(isset($data['Student']['Household']['username'])):
		$username = $data['Student']['Household']['username'];
		$password = $data['Student']['Household']['password'];
		endif;
		$DATA =sprintf("%s?USER=%s&PASS=%s",$URL,$username,$password);
		$USER = sprintf("U: %s",$username);
		$PASS = sprintf("P: %s",$password);
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

		$offsetX = 0;
		$offsetY = -8;
		$SY = (int)$data['Assessment']['esp'].'';
		$MILL = sprintf('%s  %s',$SY[0],$SY[1]);
		$DECA = sprintf('%s  %s',$SY[2],$SY[3]);
		
		$this->DrawImage(0+$offsetX ,26+$offsetY,1.1,1.1,$fullPath);
		$this->GRID['font_size']=8;
		$this->leftText(-0.5+$offsetX ,31.75+$offsetY,$MILL,12,'b');
		$this->leftText(-0.5+$offsetX ,32.5+$offsetY,$DECA,12,'b');
		$this->GRID['font_size']=7.5;
		$this->RotateText(0.5+$offsetX ,31+$offsetY,$PASS,90,'b');
		$this->RotateText(-0.25+$offsetX ,31+$offsetY,$USER,90);

		$this->leftText(6.5+$offsetX ,30.5+$offsetY,"PARENT/STUDENT PORTAL",12,'');
		$this->leftText(6.5+$offsetX ,31.5+$offsetY,'SCAN CODE OR GO TO',12,'');
		$this->GRID['font_size']=8;
		$this->leftText(6.5+$offsetX ,32.5+$offsetY,$URL,12,'b');

		$this->GRID['font_size']=10;
		$COPY_OF = strtoupper(sprintf("%s'S COPY",$data['copyOf']));
		$this->leftText(6.5+$offsetX ,29+$offsetY,$COPY_OF, 0,'b');
	}
}