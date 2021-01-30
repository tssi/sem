<?php
//Report Promotion Grade 1-3 form
include('formsheet.php');  
class rpForm extends FormSheet{
	protected static  $_width = 8.5;
	protected static $_height = 13;
	protected static $_unit ='in';
	protected static $_orient ='P';
	protected static $_allot_subjects = 15;
	function rpForm(){
		$this->showLines = !true;
		$this->FPDF(rpForm::$_orient, rpForm::$_unit,array(rpForm::$_width,rpForm::$_height));
		$this->createSheet();
		//$this->Image('../webroot/img/tmplt/stsnForm18e1.jpg',0,0,8.5,13);
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
						'base_y' => 0.387,
						'width' => 8.071,
						'height' => 1.575,
						'rows' =>8,
						'cols' =>41
					);
		$this->section($metrics);
		$this->GRID['font_size']=9;
		$this->centerText(0,1.3,'REPUBLIC OF THE PHILIPPINES',41,$style='b');
		$this->centerText(0,2,'DEPARTMENT OF EDUCATION',41,$style='b');
		$this->centerText(16,5.8,'SCHOOL YEAR:',6,$style='b');
		$this->centerText(20,5.8,$curri_info['sy'],6,$style='b');
		$this->GRID['font_size']=14;
		$this->centerText(0,3.1,'REPORT ON PROMOTIONS',41,$style='b');
		$this->GRID['font_size']=13;
		$this->centerText(0,4.15,'(GRADES I-III INCLUSIVE)',41,$style='b');
		$this->DrawLine(4.5,'h',array(17,7.5));
		$this->GRID['font_size']=8;
		$this->leftText(0.4,2.8,'DepEd','',$style='b');
		$this->leftText(2.4,2.8,'Form 18-E-1','');
		$this->leftText(1,7,'Division:','',$style='i');		
		$this->leftText(1,7.9,'School:','',$style='i');	
		$this->leftText(32,7,'Date:','',$style='i');		
		$this->leftText(32,7.9,'Teacher:','',$style='i');		
		$this->GRID['font_size']=7;
		$this->rightText(40.3,1.4,'Due the day after the','');
		$this->rightText(39.6,2,'last day prescribed for','');
		$this->rightText(39.5,2.5,'regular classes','');
		//data
		$this->leftText(3.5,7,$curri_info['div'],'',$style='i');
		$this->leftText(3.5,7.9,$curri_info['school'],'',$style='i');
		$this->centerText(11,7,'Grade '.$curri_info['grade'].'-'.$curri_info['section'],20,$style='');
		$this->leftText(34,7,$curri_info['date'],'',$style='i');
		$this->leftText(34.3,7.9,$curri_info['adv'],'',$style='i');
	} 
	function tableHeader() {
		$metrics = array(
						'base_x' => 0.197,
						'base_y' => 1.962,
						'width' => 8.071,
						'height' => 0.787,
						'rows' =>4,
						'cols' =>41
					);
		$this->section($metrics);
		$this->GRID['font_size']=8;
		$this->centerText(0,1.9,'NAME',10.5,'');
		$this->centerText(10.5,2.3,'HOME ADDRESS',9.8,'');
		$this->centerText(20.2,1.9,'YEARS IN',2,'');
		$this->centerText(20.2,2.5,'SCHOOL',2,'');
		$this->centerText(22.5,2.3,'AGE',2.5,'');
		$this->centerText(25,1.2,'TOTAL',3.2,'');
		$this->centerText(25,1.7,'NUMBER',3.2,'');
		$this->centerText(25,2.7,'OF DAYS',3.2,'');
		$this->centerText(25,3.3,'IN GRADE',3.2,'');
		$this->centerText(28.2,1.9,'FINAL',2.5,'');
		$this->centerText(28.2,2.5,'RATING',2.5,'');
		$this->centerText(30.6,1.9,'ACTION',3.4,'');
		$this->centerText(30.6,2.5,'TAKEN',3.4,'');
		$this->centerText(34,2.3,'REMARKS',7,'');
		$this->GRID['font_size']=7;
		$this->centerText(0,2.7,'(Surname first,listed alphabetically)',10.5,'');
		$this->DrawBox(0,0.5,41,3);
	}
	function table($sp_pane,$start_index=0,$ROWS = 50){
		$metrics = array(
						'base_x' => 0.197,
						'base_y' => 2.65,
						'width' => 8.071,
						'height' => 9.430,
						'rows' => 44,
						'cols' => 41
					);
		$this->section($metrics);
		$this->DrawBox(0,0,41,44);
		$this->DrawLine(0.85,'v',array(-2.74,46.7));
		$this->DrawLine(10.5,'v',array(-2.74,46.7));
		$this->DrawLine(19.75,'v',array(-2.74,46.7));
		$this->DrawLine(22.6,'v',array(-2.74,46.7));
		$this->DrawLine(24.9,'v',array(-2.74,46.7));
		$this->DrawLine(28.3,'v',array(-2.74,46.7));
		$this->DrawLine(30.6,'v',array(-2.74,46.7));
		$this->DrawLine(34,'v',array(-2.74,46.7));
		$this->DrawMultipleLines(0,44,0.733,'h');
		$this->GRID['font_size']=7.5;
		$this->leftText(1,44.75,'TOTAL AGE OF PUPILS','');
		$this->DrawLine(44.85,'h',array(7,34));
		$this->DrawLine(45.25,'h');
		$this->DrawLine(45.35,'h');
		$this->leftText(2,46,'7----9','');
		//data
		$line_ctr=1;
		$stud_count=count($sp_pane['student']);
		for($ln=0,$index=$start_index;$index<count($sp_pane['student']);$index++,$ln++){
			$this->GRID['font_size']=6;
			$this->leftText(.24,.5+($ln*.733),($index+1).".    ".$sp_pane['student'][$index]['name'],'','');
			$this->leftText(10.7,.5+($ln*.733),$sp_pane['student'][$index]['add'],'','');
			$this->centerText(21.2,.5+($ln*.733),$sp_pane['student'][$index]['yrs'],'','');
			$this->centerText(23.7,.5+($ln*.733),$sp_pane['student'][$index]['age'],'','');
			$this->centerText(26.6,.5+($ln*.733),$sp_pane['student'][$index]['att'],'','');
			$this->centerText(29.45,.5+($ln*.733),$sp_pane['student'][$index]['gen'],'','');
			$this->centerText(32.3,.5+($ln*.733),$sp_pane['student'][$index]['pro']?'Passed':'Failed','','');
			$line_ctr++;
			if($line_ctr>=$ROWS){
				return $index+1;
			}
		}
	}
}
?>
