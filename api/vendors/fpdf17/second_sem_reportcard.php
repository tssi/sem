<?php
require(__DIR__.'/formsheet.php');
class ReportCard extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 11;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
	protected static $curr_page = 1;
	protected static $page_count;
	var $__lArY;
	var $__data;

	function ReportCard(){
		$this->showLines = !true;
		$this->FPDF(ReportCard::$_orient, ReportCard::$_unit,array(ReportCard::$_width,ReportCard::$_height));
		$this->createSheet();
	}
	
	function letterhead(){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 0.35,
			'width'=> 8,
			'height'=> 1.4,
			'cols'=> 35,
			'rows'=> 7,	
		);	
		$this->section($metrics);
		$this->GRID['font_size']=8;
		$this->DrawImage(5.6,0,4.75,1.25,__DIR__ ."/spr_headr3.png");
	}
	

	
	function box($watermark){
		//$this->showLines = true;
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 0.25,
			'width'=> 8,
			'height'=> 10.5,
			'cols'=> 40,
			'rows'=> 52,	
		);	
		$this->section($metrics);
		if($watermark)
			$this->DrawImage(1,5,7,7,__DIR__."/watermark2@2x.png");
		$this->DrawBox(0,0,$metrics['cols'],$metrics['rows']);
		$this->DrawBox(0.2,0.2,$metrics['cols']-0.4,$metrics['rows']-0.4);
		$this->GRID['font_size']=7;
		$ftrLine = $metrics['rows'];
		$this->leftText(1,52.7,'Date Printed: '.date("F d,Y h:i:s"),'','');
		if($watermark)
		$this->centerText(0,$ftrLine-0.5,'"That in all things GOD may be glorified"',$metrics['cols'],'bi');
	}
	
	function hdr($student_info){
		//pr($student_info);exit;
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.75,
			'base_y'=> 1.6,
			'width'=> 7,
			'height'=> 1.4,
			'cols'=> 35,
			'rows'=> 7,	
		);	
		$this->section($metrics);
		$y = 2;
		$this->GRID['font_size']=9;
		$this->__lArY = 0;
		$this->__data = $student_info;
		$this->leftText(0,$y,'LRN:','','b');
		$this->leftText(21,$y++,'Track/Strand:','','b');
		$this->leftText(0,$y,'Student No.:','','b');
		$this->leftText(21,$y++,'Class Adviser:','','b');
		$this->leftText(0,$y,'Student Name:','','b');
		$this->leftText(21,$y++,'Principal:','','b');
		$this->leftText(0,$y++,'Year/Section:','','b');
		
		//VALUE COl 1
		$y = 2;
		$x = 6;
		$this->leftText($x,$y++,$student_info['lrn'],'','');
		$this->leftText($x,$y++,$student_info['sno'],'','');
		$this->leftText($x,$y++,$student_info['name'],'',''); // Sample output of student name
		$this->leftText($x,$y++,$student_info['year_sec'],'','');
		
		//VALUE COL 2
		$y = 2;
		$x = 26;
		$this->leftText($x,$y++,$student_info['track_strand'],'','');
		$this->leftText($x,$y++,$student_info['adviser'],'','');
		$this->leftText($x,$y++,$student_info['principal'],'','');
		
		
		$y=7.5;
		$this->GRID['font_size']=13;
		$this->centerText(0,$y++,'REPORT CARD',$metrics['cols'],'b');
		$this->GRID['font_size']=11;
		$this->centerText(0,$y++,'School Year: 2019 -2020',$metrics['cols'],'b');
	}
	
	function learning_areas($y,$sem,$grades,$averages){
		$this->showLines = !true;
		$this->__lArY  += $y;
		$metrics = array(
			'base_x'=> 0.75,
			'base_y'=> 3.5+$this->__lArY,
			'width'=> 7,
			'height'=> 2.8,
			'cols'=> 20,
			'rows'=> 14,	
		);
		$grades =  $grades[$sem];
		$gen_ave  = $averages[$sem]['gen_ave'];
		$gen_ave_recom  = $averages[$sem]['gen_ave_recom'];
		$origRows = $metrics['rows'];

		$cellHeight  =0.200;
		$MinRows = $metrics['rows'];
		$rows =  $MinRows;
		$gradesLen = count($grades)+3;
		if($gradesLen!=$MinRows){
			$rows =  $gradesLen;
		}
		$metrics['height'] =  $cellHeight * $rows;
		$metrics['rows'] =  $rows;
		$subjLines = $metrics['rows']-1;	

		$subjHeight = 1;
		if($rows > $origRows){
			$subjHeight = $origRows/$rows;
			$subjLines = $origRows;
		}
		if(count($grades)==0){
			$subjLines += 1;
		}
		$this->section($metrics);
		$this->__lArY =  $this->__lArY + ($this->GRID['cell_height']*($subjLines+2));

		$y = 1;
		$this->GRID['font_size']=9;

		$this->DrawBox(0,0,$metrics['cols'],$subjLines);
		$this->DrawLine(10,'v',array(0,$subjLines));
		$this->DrawLine(12,'v',array(1,$subjLines-1));
		$this->DrawLine(14,'v',array(0,$subjLines));
		$this->DrawLine(17,'v',array(0,$subjLines));
		
		$this->DrawLine(2,'h');
		$this->DrawLine(1,'h',array(10,4));
		
		$this->DrawLine($subjLines+1,'h',array(14,6));
		$this->DrawLine(14,'v',array($subjLines,1));
		$this->DrawLine(20,'v',array($subjLines,1));
		
		$this->drawMultipleLines(3,$subjLines-$subjHeight,$subjHeight,'h');
		

		$this->centerText(0,1.2,'LEARNING AREAS',10,'b');
		if($sem =="first_sem"){
			$this->centerText(10,0.8,'First Sem',4,'b');
		}else{
			$this->centerText(10,0.8,'Second Sem',4,'b');	
		}
		
		$this->centerText(10,1.8,'Mid Term',2,'b');
		$this->centerText(12,1.8,'Final Term',2,'b');
		$this->centerText(14,0.8,'SEMESTRAL',3,'b');
		$this->centerText(14,1.8,'GRADE',3,'b');
		$this->GRID['font_size']=8;
		$this->centerText(17,0.7,'RECOMPUTED',3,'b');
		$this->centerText(17,1.2,'FINAL',3,'b');
		$this->centerText(17,1.8,'GRADE',3,'b');
	
		$genAveLine = $subjLines+0.8;
		$this->rightText(13.75,$genAveLine,'GENERAL AVERAGE:','','b');
		$this->centerText(14.2,$genAveLine,$gen_ave,6,'b');
		$this->centerText(14.2,$genAveLine,$gen_ave_recom,6,'b');
	
		//VALUE
		$y=2.8;
		foreach($grades as $i=>$gr){
			$this->leftText(0.2,$y,$gr['subject'],10,''); //Subject Name
			$this->centerText(10,$y,$gr['midterm'],2,'');// Midterm
			$this->centerText(12,$y,$gr['finals'],2,'');// Finals
			$this->centerText(14,$y,$gr['semesteral'],3,'');// Semestral
			$this->centerText(17,$y,$gr['recomputed'],3,'');// Recomputed
			$y+=$subjHeight;
		}
		$noOfSubj = count($grades);
			//DROPBOX
			if($this->__data['status']=="DRP" && $this->__data['drop_sem']==$sem):
				$this->SetFillColor(255,255,255);
				$boxHeight = $subjHeight*$noOfSubj;
				$this->DrawBox(14,2,3,$boxHeight,'DF');
				$y =  $boxHeight/1.75;
				$this->centerText(14,$y,"DROPPED",3,'b');
				$this->centerText(14,$y+0.75,"as of ".$this->__data['drop_date'],3,'');
			endif;
		if($noOfSubj==0){
			$this->leftText(0.2,$y,"**NO SUBJECTS ENROLLED**",10,''); //Subject Name
		}
		
	
	}
	
	function observed_values($values){
		//pr($values);exit;
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.75,
			'base_y'=> 2.3,
			'width'=> 7,
			'height'=> 2.4,
			'cols'=> 20,
			'rows'=> 12,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=10;
		$this->centerText(0,-0.5,'OBSERVED VALUES',$metrics['cols'],'b');
		
		$this->DrawBox(0,0,$metrics['cols'],$metrics['rows']);
		$this->DrawLine(3,'v');
		$this->DrawLine(16,'v');
		$this->DrawLine(17,'v',array(2,10));
		$this->DrawLine(18,'v');
		$this->DrawLine(19,'v',array(2,10));
		
		
		$this->DrawLine(2,'h',array(16,4));
		$this->DrawLine(3,'h');
		
		$this->DrawLine(4,'h',array(3,17));
		$this->DrawLine(5,'h');
		$this->DrawLine(6,'h',array(3,17));
		$this->DrawLine(7,'h');
		$this->DrawLine(8,'h');
		$this->DrawLine(10,'h',array(3,17));
		
		$this->GRID['font_size']=9;
		$this->centerText(0,1.2,'CORE',3,'b');
		$this->centerText(0,2.2,'VALUES',3,'b');
		
		$this->centerText(4,1.8,'BEHAVIOR STATEMENTS',12,'b');
		$this->centerText(16,2.8,'1',1,'b');
		$this->centerText(17,2.8,'2',1,'b');
		$this->centerText(18,2.8,'1',1,'b');
		$this->centerText(19,2.8,'2',1,'b');
		$this->GRID['font_size']=7;
		$this->centerText(16,0.8,'First',2,'b');
		$this->centerText(16,1.6,'Semester',2,'b');
		$this->centerText(18,0.8,'Second',2,'b');
		$this->centerText(18,1.6,'Semester',2,'b');
		
		$this->GRID['font_size']=8;
		$this->leftText(0.2,4,'1. Maka-Diyos','','');
		$this->leftText(0.2,6,'2. Maka-Tao','','');
		$this->leftText(0.2,7.7,'3. Makakalikasan','','');
		$this->leftText(0.2,10,'4. Makabansa','','');
		
		$y = 3.8;
		$this->leftText(3.2,$y++,'Expresses one\'s spiritual beliefs while respecting the spiritual beliefs of others','','');
		$this->leftText(3.2,$y++,'Shows adherence to ethical principles by upholding truth','','');
		$this->leftText(3.2,$y++,'Is sensitive to individual, social, and cultural differences','','');
		$this->leftText(3.2,$y++,'Demonstrate contributions toward solidarity','','');
		$this->leftText(3.2,$y++,'Cares for the environment and utilizes resources wisely, judiciously and economically','','');
		$this->leftText(3.2,$y++,'Demonstrates pride in being a Filipino; exercises the rights and responsibilities of a Filipino','','');
		$this->leftText(3.2,$y++,'Citizen','','');
		$this->leftText(3.2,$y++,'Demonstrates appropriate behavior in carrying out activities in the school, community,','','');
		$this->leftText(3.2,$y++,'and country','','');
	
		//First Sem Value
		$this->GRID['font_size']=8;
		$x = 16;
		$x2 = 17;
		$y = 3.8;
		$y1 = 9.2;
		foreach($values['first_sem'] as $i=>$v){
			if($i>=count($values['first_sem'])-2){
				$this->centerText($x,$y1,$v['midterm'],1,'');
				$this->centerText($x2,$y1,$v['finals'],1,'');
				$y1=$y1+2;
			}
			else{
				$this->centerText($x,$y,$v['midterm'],1,'');
				$this->centerText($x2,$y,$v['finals'],1,'');
				$y++;
			}
		}
		
		
		//Second Sem Value
		
		/*
		$x = 18;
		$this->centerText($x,4,'***',1,'');
		$this->centerText($x,5,'***',1,'');
		$this->centerText($x,6,'***',1,'');
		$this->centerText($x,7,'***',1,'');
		$this->centerText($x,8,'***',1,'');
		$this->centerText($x,9.2,'***',1,'');
		$this->centerText($x,11.2,'***',1,'');
		//Final Term
		$this->GRID['font_size']=8;
		$x = 19;
		$this->centerText($x,4,'***',1,'');
		$this->centerText($x,5,'***',1,'');
		$this->centerText($x,6,'***',1,'');
		$this->centerText($x,7,'***',1,'');
		$this->centerText($x,8,'***',1,'');
		$this->centerText($x,9.2,'***',1,'');
		$this->centerText($x,11.2,'***',1,''); */
		
		$x = 18;
		$x2 = 19;
		$y = 3.8;
		$y1 = 9.2;
		
		foreach($values['second_sem'] as $i=>$v){
			if($i>=count($values['second_sem'])-2){
				$this->centerText($x,$y1,$v['midterm'],1,'');
				$this->centerText($x2,$y1,$v['finals'],1,'');
				$y1=$y1+2;
			}
			else{
				$this->centerText($x,$y,$v['midterm'],1,'');
				$this->centerText($x2,$y,$v['finals'],1,'');
				$y++;
			}
		}
	
	
	}
	
	function attendance($att){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.75,
			'base_y'=> 1,
			'width'=> 7,
			'height'=> 0.8,
			'cols'=> 17,
			'rows'=> 4,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=10;
		
		$this->centerText(0,-0.5,'REPORT ON ATTENDANCE',$metrics['cols'],'b');
		$this->DrawBox(0,0,$metrics['cols'],$metrics['rows']);
	
		$this->DrawLine(1,'h');
		$this->DrawLine(2,'h');
		$this->DrawLine(3,'h');
		$x=4;
		$this->DrawLine($x++,'v');
		$this->DrawLine($x++,'v');
		$this->DrawLine($x++,'v');
		$this->DrawLine($x++,'v');
		$this->DrawLine($x++,'v');
		$this->DrawLine($x++,'v');
		$this->DrawLine($x++,'v');
		$this->DrawLine($x++,'v');
		$this->DrawLine($x++,'v');
		$this->DrawLine($x++,'v');
		$this->DrawLine($x++,'v');
		$this->DrawLine($x++,'v');
		$this->DrawLine($x++,'v');
		
		$y = 1.8;
		$this->GRID['font_size']=8;
		$this->leftText(0.2,$y++,'Days of School','','b');
		$this->leftText(0.2,$y++,'Days Present','','b');
		$this->leftText(0.2,$y++,'Days Tardy','','b');
		
		$x = 4;
		$this->centerText($x++,0.8,'Aug',1,'b');
		$this->centerText($x++,0.8,'Sep',1,'b');
		$this->centerText($x++,0.8,'Oct',1,'b');
		$this->centerText($x++,0.8,'Nov',1,'b');
		$this->centerText($x++,0.8,'Dec',1,'b');
		$this->centerText($x++,0.8,'Jan',1,'b');
		$this->centerText($x++,0.8,'Feb',1,'b');
		$this->centerText($x++,0.8,'Mar',1,'b');
		$this->centerText($x++,0.8,'Apr',1,'b');
		$this->centerText($x++,0.8,'May',1,'b');
		$this->centerText($x++,0.8,'Jun',1,'b'); 
		$this->centerText($x++,0.8,'Jul',1,'b');
		$this->centerText($x++,0.8,'Total',1,'b');
		
		$x = 4;
		// Loop into attendance values
		$cal = array('AUG','SEP','OCT','NOV','DEC','JAN','FEB','MAR','APR','MAY','JUN','JUL','TOT');
		$attObj =array();
		foreach($att as $a){
			$attObj[$a['key']]=$a;
		}
		foreach($cal as $i=>$mo){
			if(isset($attObj[$mo])){
				$att =  $attObj[$mo];
				$this->centerText($x,1.8,$att['days'],1,''); // Days
				$this->centerText($x,2.8,$att['present'],1,''); // Present
				$this->centerText($x,3.8,$att['tardy'],1,''); // Tardy	
			}
			
			$x++;
			
		}
	}
	
	function legend(){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.75,
			'base_y'=> 4.9,
			'width'=> 7,
			'height'=> 1.5,
			'cols'=> 18,
			'rows'=> 8,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=10;
		$this->DrawBox(0,0,$metrics['cols'],$metrics['rows']);
		
		$this->GRID['font_size']=7;
		$y = 1;
		$this->centerText(0,$y++,'OBSERVED VALUES:',3,'b');
		$this->centerText(0,$y++,'Marking',3,'b');
		$this->centerText(0,$y++,'AO',3,'');
		$this->centerText(0,$y++,'SO',3,'');
		$this->centerText(0,$y++,'RO',3,'');
		$this->centerText(0,$y++,'NO',3,'');
		
		$y = 2;
		$this->centerText(3,$y++,'Non-Numerical Rating',3,'b');
		$this->centerText(3,$y++,'Always Observed',3,'');
		$this->centerText(3,$y++,'Sometimes Observed',3,'');
		$this->centerText(3,$y++,'Rarely Observed',3,'');
		$this->centerText(3,$y++,'Not Observed',3,'');
		
		
		
		$y = 1;
		$this->centerText(7,$y++,'LEARNING PROGRESS AND ACHIEVEMENT:',5,'b');
		$this->leftText(8,$y++,'Description','','b');
		$this->leftText(8,$y++,'Outstanding','','');
		$this->leftText(8,$y++,'Very Satisfactory','','');
		$this->leftText(8,$y++,'Satisfactory','','');
		$this->leftText(8,$y++,'Fairly Satisfactory','','');
		$this->leftText(8,$y++,'Did Not Meet Expectation',4,'');
		
		$y = 2;
		$this->leftText(12,$y++,'Grade Scale','','b');
		$this->leftText(12,$y++,'90 - 100','','');
		$this->leftText(12,$y++,'85 - 89.99','','');
		$this->leftText(12,$y++,'80 - 84.99','','');
		$this->leftText(12,$y++,'75 - 79.99','','');
		$this->leftText(12,$y++,'Below 75','','');
		
		$y = 2;
		$this->leftText(15,$y++,'Remarks','','b');
		$this->leftText(15,$y++,'Passed','','');
		$this->leftText(15,$y++,'Passed','','');
		$this->leftText(15,$y++,'Passed','','');
		$this->leftText(15,$y++,'Passed','','');
		$this->leftText(15,$y++,'Failed','','');
	
		
	}

	function certificate_of_transfer($cert=null){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.75,
			'base_y'=> 7.4,
			'width'=> 7,
			'height'=> 1.5,
			'cols'=> 36,
			'rows'=> 8,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=12;
		if($cert):

		$this->centerText(0,1,'CERTIFICATE OF TRANSFER',36,'b');
		$this->GRID['font_size']=10;
		$this->DrawLine(4,'h',array(3,7));
		$this->leftText(3,6,'Issued this ','','');
		$studX = 0;
		
			
			$this->SetFont('Arial','b',10);
			$studX = $this->GetStringWidth($cert['student'])/ $this->GRID['cell_width'];
			$this->leftText(3,3,$cert['student'],'','b');
			$this->centerText(3,3.9,$cert['promotion'],7,'b');
			$this->leftText(6.75,6,$cert['issue_date'].'.','','b');
			$this->centerText(24,10,$cert['signatory'],8,'b');
			$this->centerText(24,11,$cert['title'],8,'');
		

		$this->leftText(3+$studX,3,'is eligible for transfer and admission to','','');
		$this->leftText(10,3.85,'.','','b');

		endif;

		
	}
	function disclaimer(){
		$metrics = array(
			'base_x'=> 0.75,
			'base_y'=> 7.4,
			'width'=> 7,
			'height'=> 1.5,
			'cols'=> 36,
			'rows'=> 8,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=12;
		$message = "This Report of Grade is provided for the student's reference only and ";
		$message .= "is not valid as transfer credential. Any discrepancies between the ";
		$message .= "information printed herein and the Registrar's Office, the data ";
		$message .="provided by the Registrar's Office will be considered official. ";

		$this->centerText(5,0.5,"DISCLAIMER",27,'b');
		$this->wrapText(5,1,$message,27,'J',1);
	}
	
	function printFail($status){
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 0,
			'width'=> 8.5,
			'height'=> 11,
			'cols'=> 4,
			'rows'=> 44,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=16;
		$message = sprintf("Warning: Unable to print %s ",$status['SECTION']);
		$y = 10;
		$this->centerText(0,$y+=2,$message,$metrics['cols'],'b');
		$y+=2;
		unset($status['SECTION']);
		unset($status['VALID']);
		unset($status['WATERMARK']);
		foreach($status as $key=>$value){
			if($value!='POST')
			$this->leftText(1,$y++,"$key not posted",$metrics['cols'],'');	
			else
				$this->leftText(1,$y++,"$key OK",$metrics['cols'],'');	
		}
	}
		
	
}
?>
	