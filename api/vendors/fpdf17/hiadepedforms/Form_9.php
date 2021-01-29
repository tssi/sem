<?php
// STSN Form 9
include('formsheet.php'); 
class STSNForm extends FormSheet{
	protected static  $_width = 8.5;
	protected static $_height = 11.5;
	protected static $_unit ='in';
	protected static $_orient ='P';
	protected static $_allot_subjects = 15;
	function STSNForm(){
		$this->showLines = !true;
		$this->FPDF(STSNForm::$_orient, STSNForm::$_unit,array(STSNForm::$_width,STSNForm::$_height));
		$this->createSheet();
		
		}
	protected function section($metrics){
		$this->createGrid($metrics['base_x'] ,$metrics['base_y'],$metrics['width'],$metrics['height'],$metrics['rows'],$metrics['cols']);
		$this->SetDrawColor(0);
		if(isset($metrics['border'])){
			$this->Rect($metrics['base_x'],$metrics['base_y'],$metrics['width'],$metrics['height']);
		}
	}
	public function hdr(){
		//$this->Image('../webroot/img/tmplt/LOGO.gif',1.75,0.3,4,0.5);
			$metrics = array(
				'base_x' => 0.297,
				'base_y' => 0.177,
				'width' => 7.677,
				'height' => 0.984,
				'rows' =>5,
				'cols' =>39,
		);
		$this->section($metrics);
		$this->GRID['font_size']=7;
		$this->leftText(2,1,'DepEd Form 9','','');	
		$this->GRID['font_size']=9;
		$this->centerText(18.5,4,"APPLICATION FOR GRADUATION",'',$Style='B');	
		$this->centerText(19.5,4.6,"(Secondary)",'','');	
	}
	function PersonalInfo($std_info){
		$metrics = array(
				'base_x' => 0.297,
				'base_y' => 1.181,
				'width' => 7.874,
				'height' => 0.787,
				'rows' =>5,
				'cols' =>43,
		);
		$this->section($metrics);
		$this->GRID['font_size']=8.5;
		$this->leftText(0,0.5,'NAME:','','');
		$this->DrawLine(0.5,'h',array(2.5,18.5));
		$this->leftText(0,1.5,'PARENTS:','','');
		$this->DrawLine(1.5,'h',array(4,17));	
		$this->leftText(0,2.5,'ADDRESS:','','');	
		$this->DrawLine(2.5,'h',array(4,39));	
		$this->DrawLine(3.5,'h',array(0,43));	
		$this->leftText(0,4.5,'INTERMEDIATE LEVEL COMPLETED IN/AT:','','');
		$this->DrawLine(4.5,'h',array(14.5,16.5));	
		$this->leftText(0,5.5,'TOTAL NUMBER OF YEARS TO COMPLETE ELEMENTERY COURSE:','','');
		$this->DrawLine(5.5,'h',array(22.5,20.5));	
		$this->leftText(22,0.5,'DATE OF BIRTH:','','');
		$this->DrawLine(0.5,'h',array(28.5,14.5));		
		$this->leftText(22,1.5,'PLACE OF BIRTH:','','');	
		$this->DrawLine(1.5,'h',array(28.5,14.5));	
		$this->leftText(31.8,4.5,'SCHOOL YEAR:','','');
		$this->DrawLine(4.5,'h',array(37,6));		
		//data
		$this->leftText(3,0.4,$std_info['name'],10);
		$this->leftText(29,0.4,$std_info['dob'],10);
		$this->leftText(29,1.4,$std_info['pob'],10);
		$this->leftText(4,1.4,$std_info['gaur'],10);
		$this->centerText(35,4.4,$std_info['sy'].'-'.($std_info['sy']+1),10);
		$this->leftText(4,2.4,$std_info['add'],'','');
		$this->centerText(17,4.4,$std_info['lvlcomp'],'','');
		$this->leftText(23,5.4,$std_info['total_yelem'],'','');
	}
	function tableOne($x,$y,$z,$grades){
		$metrics = array(
				'base_x' => 0.297+$x,
				'base_y' => 2.1+$y,
				'width' => 3.91,
				'height' => 2.559,
				'rows' =>13,
				'cols' =>18,
		);
		$this->section($metrics);
		$this->DrawBox(0,0,18,15);
		$this->DrawLine(1.7,'h',array(0,18));	
		$this->DrawMultipleLines(3.1,12.5,0.85,'h');
		$this->DrawLine(6.6,'v',array(1.7,10.7));	
		$this->DrawLine(10.3,'v',array(1.7,10.7));	
		$this->DrawLine(14.1,'v',array(1.7,10.7));	
		$this->GRID['font_size']=8;
		$this->leftText(0.2,0.75,$z,'',$style='B');
		$this->leftText(10,0.75,'SY:','');
		$this->DrawLine(0.75,'h',array(10.9,3));
		$this->leftText(14.1,0.75,'-','','');
		$this->DrawLine(0.75,'h',array(14.5,3));	
		$this->leftText(0.2,1.5,'SCHOOL:','','');
		$this->leftText(2,2.8,'SUBJECTS','','');	
		$this->leftText(7.8,2.3,'FINAL','','');	
		$this->leftText(7.6,2.8,'GRADE','','');
		$this->leftText(11.3,2.3,'ACTION','','');
		$this->leftText(11.3,2.8,'TAKEN','','');
		$this->leftText(15.1,2.3,'CREDIT','','');
		$this->leftText(15,2.8,'EARNED','','');	
		if($grades){
			for($i=0;$i<count($grades['dtl']);$i++){
				$this->leftText(0.09,3.75+($i*.85),$grades['dtl'][$i]['subject'],8);
				$this->centerText(6,3.75+($i*.85),$grades['dtl'][$i]['cs_ave'],5);
				$this->centerText(14.5,3.75+($i*.85),$grades['dtl'][$i]['earned'],3);
				$this->centerText(10.7,3.75+($i*.85),$grades['dtl'][$i]['action'],3);
			}
		}		
		$this->leftText(0.2,13.2,'SCHOOL DAYS:','','');
		$this->DrawLine(13.2,'h',array(4.5,3));
		$this->leftText(11,13.2,'TOTAL UNITS:','','');
		$this->DrawLine(13.2,'h',array(14.6,3));
		$this->leftText(0.2,13.9,'DAYS PRESENT:','','');
		$this->DrawLine(13.9,'h',array(4.5,3));
		$this->leftText(0.2,14.6,'TOTAL NUMBER OF YEARS IN SCHOOL TO DATE:','','');
		$this->DrawLine(14.6,'h',array(12.5,3));
		//data
		if(isset($grades['hdr']['school'])&&isset($grades['hdr']['sy'])){
			$this->leftText(3,1.5,$grades['hdr']['school'],'','');
			$this->leftText(11.90,0.65,$grades['hdr']['sy'].'                '.($grades['hdr']['sy']+1),'');
		}
		if(isset($grades['foot']['tdos'])&&isset($grades['foot']['tdp'])&&isset($grades['foot']['tunits'])&&isset($grades['foot']['total_ys'])){
			$this->leftText(5.50,13.1,$grades['foot']['tdos'],'','');
			$this->leftText(5.50,13.8,$grades['foot']['tdp'],'','');
			$this->leftText(15,13.1,$grades['foot']['tunits'],'','');
			$this->leftText(13.5,14.5,$grades['foot']['total_ys'],'','');
		}
		
	}
	function tableTwo($x,$y,$z,$grades){
		$metrics = array(
				'base_x' => 0.297+$x,
				'base_y' => 2.1+$y,
				'width' => 3.91,
				'height' => 2.559,
				'rows' =>13,
				'cols' =>18,
		);
		$this->section($metrics);
		$this->DrawBox(0,0,18,11);
		$this->DrawLine(1.7,'h',array(0,18));	
		$this->DrawMultipleLines(3.2,9,0.85,'h');
		$this->DrawLine(6.6,'v',array(1.7,6.6));	
		$this->DrawLine(10.3,'v',array(1.7,6.6));	
		$this->DrawLine(14.1,'v',array(1.7,6.6));	
		$this->GRID['font_size']=8;
		$this->leftText(0.2,0.75,$z,'',$style='B');
		$this->leftText(10,0.75,'SY:','','');
		//data
		$this->leftText(3,1.5,$grades['hdr']['school'],'','');
		$this->leftText(11.90,0.65,$grades['hdr']['sy'].'                '.($grades['hdr']['sy']+1),'');
		$this->leftText(5.50,8.9,$grades['foot']['tdos'],'','');
		$this->leftText(5.50,9.7,$grades['foot']['tdp'],'','');
		$this->leftText(15,8.9,$grades['foot']['tunits'],'',''); 
		//End of data	
		$this->DrawLine(0.75,'h',array(10.9,3));
		$this->leftText(14.1,0.75,'-','','');
		$this->DrawLine(0.75,'h',array(14.5,3));	
		$this->leftText(0.2,1.5,'SCHOOL:','','');
		$this->leftText(2,2.8,'SUBJECTS','','');	
		$this->leftText(7.8,2.3,'FINAL','','');	
		$this->leftText(7.6,2.8,'GRADE','','');
		$this->leftText(11.3,2.3,'ACTION','','');
		$this->leftText(11.3,2.8,'TAKEN','','');
		$this->leftText(15.1,2.3,'CREDIT','','');
		$this->leftText(15,2.8,'EARNED','','');
		$this->leftText(0.2,9,'SCHOOL DAYS:','','');
		$this->DrawLine(9,'h',array(4.5,3));
		$this->leftText(11,9,'TOTAL UNITS:','','');
		$this->DrawLine(9,'h',array(14.6,3));
		$this->leftText(0.2,9.8,'DAYS PRESENT:','','');
		$this->DrawLine(9.8,'h',array(4.5,3));
		$this->leftText(0.2,10.6,'CHECKED AND EVALUATED BY:','','');
		$this->leftText(9,10.5,$grades['foot']['eval_by'],'','');
		$this->DrawLine(10.6,'h',array(8.5,8.5));	
		if($grades){
			for($i=0;$i<count($grades['dtl']);$i++){
			$this->leftText(0.20,3.75+($i*.85),$grades['dtl'][$i]['subject'],8);
			$this->centerText(6,3.75+($i*.85),$grades['dtl'][$i]['cs_ave'],5);
			$this->centerText(10.5,3.75+($i*.85),$grades['dtl'][$i]['earned'],3);
			$this->centerText(14.5,3.75+($i*.85),$grades['dtl'][$i]['action'],3);
			}
		}
	}
	function tableThree($subjects,$std_info){
		$metrics = array(
				'base_x' => 04.247,
				'base_y' => 8.06,
				'width' => 3.91,
				'height' => 2.559,
				'rows' =>13,
				'cols' =>18,
		);
		$this->section($metrics);
		$this->DrawBox(0,0,18,11);
		$this->DrawLine(0.85,'h',array(0,18));	
		$this->DrawMultipleLines(0.85,10.6,0.83,'h');
		$this->DrawLine(9.85,'v',array(0.85,10.1));	
		$this->GRID['font_size']=8;
		$this->leftText(0.2,0.75,'','',$style='B');
		$this->leftText(0.2,0.65,'SUMMARY OF UNITS EARNED','',$style='B');
		$this->leftText(0.2,10.6,'TOTAL','',$style='b');
		$y = 1.70;
		$total = 0;
		$this->GRID['font_size']=7;
		foreach($subjects as $subject){
			$sub = str_replace(' ','',$subject['nomen']).$std_info['sno'];
			if($sub == $subject['code']){
				$this->leftText(0.50,$y*.84,$subject['nomen'],5,'B');
				$this->centerText(11,$y*.84,$subject['unit'],5);//number_format($subject['unit'],2,'.','')
				$total +=$subject['unit']; 
				$y++;
			}
		}
		$this->centerText(11,10.6,number_format($total,2,'.',''),5);
	}
	function ftr(){
	$metrics = array(
			'base_x' => 0.297,
			'base_y' => 10.25,
			'width' => 7.874,
			'height' => 1.378,
			'rows' =>7,
			'cols' =>40,
	);
	$this->section($metrics);
	$this->GRID['font_size']=8;
	$this->leftText(30,0.6,'Date:','','');
	$this->DrawLine(0.6,'h',array(32,7));
	$this->leftText(4,1.6,'I   certify  that  this  is  true  record  of','','');
	$this->DrawLine(1.6,'h',array(14.3,25.5));
	$this->leftText(0.2,2.4,'AS PER REQUIREMENT OF DEPARTMENT OF EDUCATION.He/she is eligable for graduation on March','','');
	$this->DrawLine(2.4,'h',array(27,2.5));
	$this->leftText(30,2.4,'2013.','','');
	$this->leftText(31.5,4.4,'NERISSA M. GUILERMO','','');
	$this->leftText(34,5.1,'Principal','','');
	}
}