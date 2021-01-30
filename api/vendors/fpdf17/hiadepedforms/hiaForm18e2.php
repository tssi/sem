<?php
//Report Promotion Grade 4-6 form
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
		//$this->Image('../webroot/img/tmplt/stsnForm18e2.jpg',0,0,13,8.5);
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
		$this->GRID['font_size']=9;
		$this->centerText(0,0.5,'REPUBLIC OF THE PHILIPPINES',62,$style='b');
		$this->centerText(0,1.2,'DEPARTMENT OF EDUCATION',62,$style='b');
		$this->GRID['font_size']=14;
		$this->centerText(0,3.1,'REPORT ON PROMOTIONS',62,'');
		$this->GRID['font_size']=8;
		$this->centerText(0,3.85,'(GRADES IV-VI INCLUSIVE)',62,$style='b');
		$this->GRID['font_size']=8;
		$this->leftText(0.6,0.8,'DepEd','',$style='b');
		$this->leftText(2.6,0.8,'Form 18-E-1','');
		$this->leftText(1,5,'CURRICULUM:','',$style='b');		
		$this->leftText(48.5,5,'GRADE:','',$style='b');		
		$this->leftText(54.5,5,'SECTION:','',$style='b');		
		$this->leftText(1,5.75,'School:','',$style='i');		
		$this->leftText(23,5.75,'Municipality / City:','',$style='i');		
		$this->leftText(36,5.75,'Division:','',$style='i');		
		$this->leftText(51,5.75,'Date:','',$style='i');
		//data
		$this->leftText(5,5,$curri_info['curri'],'',$style='');	
		$this->leftText(51,5,$curri_info['grade'],'',$style='');
		$this->leftText(57.3,5,$curri_info['section'],'',$style='');
		$this->leftText(3,5.75,$curri_info['school'],'',$style='i');
		$this->leftText(27.5,5.75,$curri_info['city'],'',$style='i');
		$this->leftText(38.2,5.75,$curri_info['div'],'',$style='i');
		$this->leftText(52.5,5.75,$curri_info['date'],'',$style='i');
	} 
 	 function rightHeader() {
		$metrics = array(
						'base_x' => 9.349,
						'base_y' => 0.194,
						'width' => 2.362,
						'height' => 0.591,
						'rows' =>3,
						'cols' =>12
					);	
		$this->section($metrics);
		$this->GRID['font_size']=7;
		$this->leftText(0.5,1.4,'Due one week before the last prescribed regular class day','');
		$this->leftText(0,2,'for Grade VI pupils.','');
		$this->leftText(0.5,2.6,'Due the day following the last prescribed regular class day','');
		$this->leftText(0,3.2,'for pupils in Grades IV-V.','');
	}
	function table($sp_pane,$start_index=0,$ROWS = 50) {
		$metrics = array(
						'base_x' => 0.197,
						'base_y' => 1.478,
						'width' => 12.598,
						'height' => 6.690,
						'rows' => 34,
						'cols' => 64
					);
		$this->section($metrics);
		$this->DrawBox(0,0,64,34,'v');
		$this->DrawLine(2.6,'h');
		$this->DrawLine(1.2,'h',array(32.2,24.1));
		$this->DrawLine(0.9,'v');
		$this->DrawLine(10.5,'v');
		$this->DrawLine(24,'v');
		$this->DrawLine(26.9,'v');
		$this->DrawLine(28.9,'v');
		$this->DrawLine(32.2,'v');
		$this->DrawLine(34.61,'v',array(1.2,32.8));
		$this->DrawLine(37.02,'v',array(1.2,32.8));
		$this->DrawLine(39.43,'v',array(1.2,32.8));
		$this->DrawLine(41.84,'v',array(1.2,32.8));
		$this->DrawLine(44.25,'v',array(1.2,31.4));
		$this->DrawLine(44.25,'v',array(33.35,0.65));
		$this->DrawLine(46.66,'v',array(1.2,31.4));
		$this->DrawLine(46.6,'v',array(33.35,0.65));	
		$this->DrawLine(49.07,'v',array(1.2,31.4));
		$this->DrawLine(49.07,'v',array(33.35,0.65));
		$this->DrawLine(51.48,'v',array(1.2,31.4));
		$this->DrawLine(51.48,'v',array(33.35,0.65));
		$this->DrawLine(53.89,'v',array(1.2,32.8));
		$this->DrawLine(56.3,'v');
		$this->DrawLine(59.2,'v');
		$this->DrawMultipleLines(2.6,34,0.698,'h');
		$this->GRID['font_size']=8;
		$this->centerText(0.9,1,'NAMES',9.6,'');
		$this->centerText(10.5,1.5,'HOME ADDRESS',13.5,'');
		$this->centerText(24,1,'YEARS IN',2.9,'');
		$this->centerText(24,1.9,'SCHOOL',2.9,'');
		$this->centerText(26.9,1.5,'AGE',2.1,'');
		$this->centerText(28.9,0.7,'TOTAL',3.3,'');
		$this->centerText(28.9,1.2,'NUMBER',3.3,'');
		$this->centerText(28.9,1.7,'OF DAYS',3.3,'');
		$this->centerText(28.9,2.2,'IN GRADE',3.3,'');
		$this->centerText(32.2,0.75,'FINAL RATING',24.2,$style='b');
		$this->centerText(56.3,1,'GENERAL',2.9,'');
		$this->centerText(56.3,1.9,'AVERAGE',2.9,'');
		$this->centerText(59.2,1,'ACTION',4.8,$style='b');
		$this->centerText(59.2,1.9,'TAKEN',4.8,$style='b');
		$this->GRID['font_size']=7;
		$this->centerText(0.9,1.9,'(Surname first,listed alphabetically)',9.6,'');
		$this->GRID['font_size']=7;
		//data
		for($i=0;$i<count($sp_pane['subjects']);$i++){
			$this->centerText(33.5+($i*2.40),2.2,$sp_pane['subjects'][$i]['alias'],'',$style='b');
		}
		$line_ctr=1;
		$stud_count=count($sp_pane['student']);
		for($ln=0,$index=$start_index;$index<count($sp_pane['student']);$index++,$ln++){
			$this->GRID['font_size']=6;
			$this->leftText(.22,3.1+($ln*.698),($index+1).".    ".$sp_pane['student'][$index]['name'],'','');
			$this->leftText(10.6,3.1+($ln*.698),$sp_pane['student'][$index]['add'],'','');
			$this->centerText(25.5,3.1+($ln*.698),$sp_pane['student'][$index]['yrs'],'','');
			$this->centerText(27.9,3.1+($ln*.698),$sp_pane['student'][$index]['age'],'','');
			$this->centerText(30.5,3.1+($ln*.698),$sp_pane['student'][$index]['att'],'','');
			$this->centerText(57.7,3.1+($ln*.698),$sp_pane['student'][$index]['gen'],'','');
			$this->centerText(61.7,3.1+($ln*.698),$sp_pane['student'][$index]['pro']?'Passed':'Failed','','');
			for($b=0;$b<count($sp_pane['student'][$index]['grades']);$b++){
				$this->leftText(32.9+($b*2.4),3.1+($ln*.698),$sp_pane['student'][$index]['grades'][$b]['fg'],1);
			} 
			$line_ctr++;
			if($line_ctr>=$ROWS){
				return $index+1;
			}
		}
		$this->centerText(41.84,33.15,'The (averaging cumulative) system was used.',12,'');
	} 
}
?>
