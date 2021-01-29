<?php
//Report Promotion Grade 1-3 form
include('formsheet.php');  
class rpForm extends FormSheet{
	protected static  $_width = 8.5;
	protected static $_height = 13;
	protected static $_unit ='in';
	protected static $_orient ='L';
	protected static $_allot_subjects = 15;
	function rpForm(){
		$this->showLines = !true;
		$this->FPDF(rpForm::$_orient, rpForm::$_unit,array(rpForm::$_width,rpForm::$_height));
		$this->createSheet();
		//$this->Image('../webroot/img/tmplt/stsnForm18a_back.jpg',0,0,13,8.5);
	}
	protected function section($metrics){
		$this->createGrid($metrics['base_x'] ,$metrics['base_y'],$metrics['width'],$metrics['height'],$metrics['rows'],$metrics['cols']);
		$this->SetDrawColor(0);
		if(isset($metrics['border'])){
			$this->Rect($metrics['base_x'],$metrics['base_y'],$metrics['width'],$metrics['height']);
		}
	}
	function hdr($curri_info) {
		$metrics = array(
						'base_x' => 0.197,
						'base_y' => 0.294,
						'width' => 12.598,
						'height' => 1.181,
						'cols' =>62,
						'rows' =>6
					);
		$this->section($metrics);
		$this->GRID['font_size']=5;
		$this->centerText(18.35,0.3,'REPUBLIC OF THE PHILIPPINES',20,'');
		$this->centerText(0,0.7,'DEPARTMENT OF EDUCATION',62,'');
		$this->centerText(0,1.1,'NATIONAL CAPITAL REGION',62,'');
		$this->centerText(0,1.5,'DIVISION OF CITY SCHOOLS, QUEZON CITY',62,'');
		$this->GRID['font_size']=8;
		$this->centerText(19,2.5,'REPORT ON SECONDARY PROMOTIONS',20,$style='b');
		$this->GRID['font_size']=7;
		$this->leftText(0,0,'DECS FORM 18-A','','');
		$this->leftText(0,0.6,'Revised October 1978','');
		$this->leftText(0,2.5,'Curriculum:','','');		
		$this->leftText(48,2.5,'Curriculum Year:','','');		
		$this->leftText(54.5,2.5,'Section:','','');		
		$this->leftText(1,3.9,'School:','','');		
		$this->leftText(32,3.9,'City:','','');		
		$this->leftText(39,3.9,'Date:','','');
		//data
		$this->leftText(3,2.5,$curri_info['curri'],'',$styl='');
		$this->leftText(51.7,2.5,$curri_info['curri_yr'],'',$styl='');
		$this->leftText(56.6,2.5,$curri_info['section'],'',$styl='');
		$this->leftText(3,3.9,$curri_info['school'],'',$styl='');
		$this->leftText(33.5,3.9,$curri_info['city'],'',$styl='');
		$this->leftText(40.5,3.9,$curri_info['date'],'',$styl='');
	 } 
	function table($sp_pane) {
		$metrics = array(
						'base_x' => 0.154,
						'base_y' => 1.166,
						'width' => 12.442,
						'height' => 6.890,
						'rows' => 35,
						'cols' => 63
					);
		$this->section($metrics);
		$this->DrawBox(0,0,64,35,'v');
		$this->DrawLine(0.55,'h',array(38.9,13.8));
		$this->DrawLine(1.3,'h',array(25,39));
		$this->DrawLine(2.8,'h',array(0,64));
		$this->DrawLine(0.8,'v');
		$this->DrawLine(8.1,'v');
		$this->DrawLine(19.1,'v');
		$this->DrawLine(21,'v');
		$this->DrawLine(22.8,'v');
		$this->DrawMultipleLines(25,38.9,3.4625,'v');
		$this->DrawLine(42.3625,'v',array(0.55,34.45));
		$this->DrawLine(45.825,'v',array(0.55,34.45));
		$this->DrawLine(49.2875,'v',array(0.55,34.45));
		$this->DrawLine(52.7,'v');
		$this->DrawLine(56.1,'v');
		$this->DrawLine(58,'v',array(1.3,33.7));
		$this->DrawLine(59.7,'v',array(1.3,33.7));
		$this->DrawLine(61.15,'v');
		for($col=25+1.7325;$col<=52.7+3.4625;$col+=3.4625){ //final rating and action taken vertical line
			$this->DrawLine($col,'v',array(1.3,33.65));
		}
		$this->GRID['font_size']=8;
		$this->centerText(0.9,1.3,'NAME',7,$style='b');
		$this->centerText(7.9,1.6,'ADDRESS',11,$style='b');
		$this->GRID['font_size']=6;
		$this->centerText(19.05,1,'Years',2,'');
		$this->centerText(19.05,1.45,'In',2,'');
		$this->centerText(19.05,1.9,'School',2,'');
		$this->centerText(21,1.5,'AGE',1.8,'');
		$this->centerText(56.10125,1,'CREDIT EARNED',4.5,'');
		$this->GRID['font_size']=3.8;
		$this->centerText(23.4,0.9,'Total Numbers of',2.2,'');
		$this->centerText(22.8,1.3,'Days of',2.2,'');
		$this->centerText(22.8,1.7,'Attendance in',2.2,'');
		$this->centerText(22.8,2.1,'Curriculum Year',2.2,'');
		$this->GRID['font_size']=6.5;
		for($col=25;$col<=52.75;$col+=3.4625){
			$this->centerText($col,2,'Final',1.73125,'');
			$this->centerText($col,2.6,'Rating',1.73125,'');
		}
		for($col=25+1.73125;$col<=56.375;$col+=3.4625){
			$this->centerText($col,2,'Action',1.73125,'');
			$this->centerText($col,2.6,'Taken',1.73125,'');
		} 
		$this->centerText(56.55,2,'Previous',1,'');
		$this->centerText(56.55,2.6,'Year',1,'');
		$this->centerText(58.35,2,'Current',1,'');
		$this->centerText(58.35,2.6,'Year',1,'');
		$this->centerText(59.9,2.3,'Total',1,'');
		$this->centerText(61,1.9,'Promoted',3,'');
		$this->centerText(61,2.25,'or',3,'');
		$this->centerText(61,2.6,'Retained',3,'');
		$this->GRID['font_size']=6;
		$this->centerText(0.9,1.9,'(Surname first,listed alphabetically)',7,'');
		$this->centerText(38.9,0.5,'M A K A B A Y A N',14,$style='b');
		//data
		for($i=0;$i<count($sp_pane['subjects']);$i++){
		$this->GRID['font_size']=5;
			$this->centerText(26.9+($i*3.44),1,$sp_pane['subjects'][$i]['alias'],'','');
		}
	} 
	/***********Table Horizontal Lines************/	
	function table_hor_lines($sp_pane,$start_index=0,$ROWS = 53) {
		$metrics = array(
						'base_x' => 0.154,
						'base_y' => 1.726,
						'width' => 12.642,
						'height' => 6.33,
						'rows' => 53,
						'cols' => 63
					);
		$this->section($metrics);
		$this->DrawMultipleLines(1,54,1,'h');
		$this->GRID['font_size']=7;
		$this->leftText(0,53.8,'TOTAL AGE OF THE STUDENTS','','');
		$this->leftText(20,53.8,'607 3/4','','');
		$this->leftText(22.6,53.8,'Initials 1','','');
		$this->centerText(0,54.8,'1. Initials of Teachers should be written in spaces at the bottom of the columns headed by the subjects taught',63,'');
		 for($row=0.8,$ctr=1;$row<=53;$row++,$ctr++){
		$this->rightText(0.7,$row,$ctr,'');
		} 
		//data
		$line_ctr = 0;
		$stud_count=count($sp_pane['student']);
		for($ln=0,$index=$start_index;$index<count($sp_pane['student']);$index++,$ln++){
			$this->GRID['font_size']=5;
			$this->fitText(.90,.7+$ln,$sp_pane['student'][$index]['name'],2.38,'');
			$this->leftText(8.2,.7+$ln,$sp_pane['student'][$index]['add'],'','');
			$this->centerText(19.7,.7+$ln,$sp_pane['student'][$index]['yrs'],'','');
			$this->centerText(21.5,.7+$ln,$sp_pane['student'][$index]['age'],'','');
			$this->centerText(23.4,.7+$ln,$sp_pane['student'][$index]['att'],'','');

			for($b=0;$b<count($sp_pane['student'][$index]['grades']);$b++){
				$this->leftText(25+($b*3.42),.7+$ln,$sp_pane['student'][$index]['grades'][$b]['fg'],1);
				if($sp_pane['student'][$index]['grades'][$b]['fg']>=75){
					$this->leftText(27+($b*3.42),.7+$ln,"P",1);
				}
				else
					{
					$this->leftText(27+($b*3.42),.7+$ln,"F",1);
				} 
			}			
			$line_ctr++;
			if($line_ctr>=$ROWS){
				return $index+1;
			}
		}
	}
	function bottom_ver_lines() {
		$metrics = array(
						'base_x' => 0.154,
						'base_y' => 8.06,
						'width' => 12.442,
						'height' => 0.11,
						'rows' => 1,
						'cols' => 63
					);
		$this->section($metrics);
		$this->DrawMultipleLines(25,38.9,3.4625,'v');
		$this->DrawLine(42.3625,'v');
		$this->DrawLine(45.825,'v');
		$this->DrawLine(49.2875,'v');
		$this->DrawLine(52.7,'v');
		$this->DrawLine(56.1,'v');
		$this->DrawLine(59.7,'v');
		$this->DrawLine(61.15,'v');
		$this->DrawLine(64,'v');
	}
}
?>
