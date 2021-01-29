<?php
// STSN Form 137-A
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
		//$this->Image('../webroot/img/tmplt/form137a.jpg',0,0,8.5,11.5);
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
						'base_y' => 0.197,
						'width' => 7.677,
						'height' => 0.984,
						'rows' =>5,
						'cols' =>39
					);
		$this->section($metrics);
		$this->GRID['font_size']=6;
		$this->leftText(0,1,'Deped Form 137 - A','','');	
		$this->GRID['font_size']=8;
		$this->leftText(30,2,'Copy of this record was sent to','','');	
		$this->leftText(30,2.6,'the principal of','','');
		$this->DrawLine(2.7,'h',array(33.8,5.2));	
		$this->leftText(30,3.2,'on','','');
		$this->DrawLine(3.3,'h',array(31,8));	
		$this->GRID['font_size']=10;
		$this->centerText(18.5,5,"PRE-SCHOOL PUPIL'S PERMANENT RECORD",'','');	
	}
	function PersonalInfo($std_info){
		$metrics = array(
						'base_x' => 0.297,
						'base_y' => 1.181,
						'width' => 7.874,
						'height' => 0.787,
						'rows' =>5,
						'cols' =>43
					);
		$this->section($metrics);
		$this->GRID['font_size']=9;
		$this->leftText(0,1.5,'Name:','','');
		$this->leftText(7,1.5,$std_info['name'],'','');
		$this->DrawLine(1.7,'h',array(7,18));
		$this->leftText(0,2.3,'Date of Birth:','','');
		$this->leftText(7,2.4,$std_info['dob'],'','');
		$this->DrawLine(2.5,'h',array(7,18));	
		$this->leftText(0,3.2,'Parent/Guardian:','','');
		$this->leftText(7,3.2,$std_info['par'],'','');
		$this->DrawLine(3.4,'h',array(7,18));	
		$this->leftText(0,4,'Home Address:','','');
		$this->leftText(7,4.1,$std_info['add'],'','');
		$this->DrawLine(4.2,'h',array(7,18));	
		$this->leftText(26.8,1.5,'Sex:','','');
		$this->leftText(33,1.5,$std_info['gender'],'','');
		$this->DrawLine(1.7,'h',array(33,10));		
		$this->leftText(26.8,2.3,'Place of Birth:','','');	
		$this->leftText(33,2.4,$std_info['pob'],'','');	
		$this->DrawLine(2.5,'h',array(33,10));	
		$this->leftText(26.8,3.2,'Occupation:','','');
		$this->leftText(33,3.2,$std_info['occ'],'','');
		$this->DrawLine(3.4,'h',array(33,10));		
	}
	function tableOne($g4tog6){
		$metrics = array(
						'base_x' => 0.297,
						'base_y' => 1.943,
						'width' => 7.874,
						'height' => 1.440,
						'rows' =>7,
						'cols' =>40
					);
		$this->section($metrics);
		$this->Drawbox(0,0,40,7);
		$this->DrawLine(2,'h',array(0,34.5));
		$this->DrawLine(2.92,'h',array(6.6,27.9));
		$this->DrawLine(3,'h',array(6.6,27.9));
		$this->DrawLine(4,'h',array(0,40));
		$this->DrawLine(4.1,'h',array(0,40));
		$this->DrawLine(5,'h',array(0,40));
		$this->DrawLine(6,'h',array(0,40));
		$this->GRID['height']=0.82;
		$this->DrawLine(34.5,'v');
		$this->GRID['font_size']=9;
		$this->leftText(0.2,0.6,'Classified as:','','');
		$this->DrawLine(0.7,'h',array(6.5,12));
		$this->leftText(0.2,1.6,'School:','','');
		$this->DrawLine(1.7,'h',array(6.5,12));
		$this->leftText(19,0.6,'School Year:','','');
		$this->DrawLine(0.7,'h',array(23.5,7));
		//data
		if(isset($g4tog6['hdr']['clas'])&&isset($g4tog6['hdr']['school'])&&isset($g4tog6['hdr']['sy'])){
			$this->leftText(7,0.6,$g4tog6['hdr']['clas'],'','');
			$this->leftText(7,1.5,$g4tog6['hdr']['school'],'','');
			$this->leftText(24,0.6,$g4tog6['hdr']['sy'],'','');
		}
		$this->leftText(36.25,2.25,'Picture','','');
		$this->GRID['base_y']=2.362;
		$this->GRID['height']=0.4;
		$this->DrawLine(6.6,'v');
		$this->DrawLine(16.4,'v');
		$this->DrawLine(26.2,'v');
		$this->leftText(10,0.75,'Final Rating','',$style='B');
		//data
		$this->leftText(10,1.75,'XXXXXX','',$style='');
		$this->leftText(19,1.75,'PASSED/FAILED','',$style='');
		$this->leftText(29,1.75,'REMARKS','',$style='');
		
		$this->leftText(19,0.75,'Action Taken','',$style='B');
		$this->leftText(29,0.75,'Remarks','',$style='B');
		$this->GRID['base_y']=2.79;
		$this->GRID['height']=0.59;
		$this->leftText(0.2,1.6,'Days of School','','');
		$this->leftText(0.2,2.6,'Days Present','','');
		$this->DrawLine(6.6,'v');
		$this->leftText(7.2,0.6,'June','','');
		$this->DrawLine(9.05,'v');
		$this->leftText(9.75,0.6,'July','','');
		$this->DrawLine(11.5,'v');
		$this->leftText(12.25,0.6,'Aug','','');
		$this->DrawLine(13.95,'v');
		$this->leftText(14.6,0.6,'Sept','','');
		$this->DrawLine(16.4,'v');
		$this->leftText(17.05,0.6,'Oct','','');
		$this->DrawLine(18.9,'v');
		$this->leftText(19.55,0.6,'Nov','','');
		$this->DrawLine(21.35,'v');
		$this->leftText(22,0.6,'Dec','','');
		$this->DrawLine(23.8,'v');
		$this->leftText(24.45,0.6,'Jan','','');
		$this->DrawLine(26.2,'v');
		$this->leftText(26.9,0.6,'Feb','','');
		$this->DrawLine(28.65,'v');
		$this->leftText(29.35,0.6,'Mar','','');
		$this->DrawLine(31.1,'v');
		$this->leftText(31.8,0.6,'Apr','','');
		$this->DrawLine(33.55,'v');
		$this->leftText(35.8,0.6,'TOTAL','','');
		//attendance
		$this->centerText(7.8,1.65,$g4tog6['att']['ds']['june'],'','');
		$this->centerText(10.3,1.65,$g4tog6['att']['ds']['july'],'','');
		$this->centerText(12.7,1.65,$g4tog6['att']['ds']['aug'],'','');
		$this->centerText(15.2,1.65,$g4tog6['att']['ds']['sep'],'','');
		$this->centerText(17.6,1.65,$g4tog6['att']['ds']['oct'],'','');
		$this->centerText(20.1,1.65,$g4tog6['att']['ds']['nov'],'','');
		$this->centerText(23,1.65,$g4tog6['att']['ds']['dec'],'','');
		$this->centerText(25,1.65,$g4tog6['att']['ds']['jan'],'','');
		$this->centerText(27.4,1.65,$g4tog6['att']['ds']['feb'],'','');
		$this->centerText(29.8,1.65,$g4tog6['att']['ds']['mar'],'','');
		$this->centerText(32.3,1.65,$g4tog6['att']['ds']['apr'],'','');		
		$this->centerText(7.8,2.65,$g4tog6['att']['dp']['june'],'','');
		$this->centerText(10.3,2.65,$g4tog6['att']['dp']['july'],'','');
		$this->centerText(12.7,2.65,$g4tog6['att']['dp']['aug'],'','');
		$this->centerText(15.2,2.65,$g4tog6['att']['dp']['sep'],'','');
		$this->centerText(17.6,2.65,$g4tog6['att']['dp']['oct'],'','');
		$this->centerText(20.1,2.65,$g4tog6['att']['dp']['nov'],'','');
		$this->centerText(23,2.65,$g4tog6['att']['dp']['dec'],'','');
		$this->centerText(25,2.65,$g4tog6['att']['dp']['jan'],'','');
		$this->centerText(27.4,2.65,$g4tog6['att']['dp']['feb'],'','');
		$this->centerText(29.8,2.65,$g4tog6['att']['dp']['mar'],'','');
		$this->centerText(32.3,2.65,$g4tog6['att']['dp']['apr'],'','');
		//total attendance
		$this->centerText(36.50,1.65,$g4tog6['att']['ds']['total'],'','');
		$this->centerText(36.50,2.65,$g4tog6['att']['dp']['total'],'','');
	}
	function tableTwo($y,$g4tog6){
		$metrics = array(
						'base_x' => 0.297,
						'base_y' => 3.433+$y,
						'width' => 7.874,
						'height' => 3.145,
						'rows' =>16,
						'cols' =>40
					);
		$this->section($metrics);
		$this->Drawbox(0,0,40,16);
		$this->DrawLine(2.2,'h',array(0,34.5));
		$this->DrawLine(3.2,'h',array(6.6,19.6));
		$this->DrawLine(4.79,'h',array(0,34.5));
		$this->DrawLine(5.58,'h',array(0,34.5));
		$this->DrawLine(6.37,'h',array(0,34.5));
		$this->DrawLine(7.16,'h',array(0,34.5));
		$this->DrawLine(7.95,'h',array(0,34.5));
		$this->DrawLine(8.74,'h',array(0,34.5));
		$this->DrawLine(9.53,'h',array(0,34.5));
		$this->DrawLine(10.32,'h',array(0,34.5));
		$this->DrawLine(11.11,'h',array(0,34.5));
		$this->DrawLine(11.9,'h',array(0,34.5));
		$this->DrawLine(12.1,'h',array(0,40));
		$this->DrawMultipleLines(13,15,1,'h');
		$this->GRID['font_size']=9;
		$this->leftText(0.2,0.6,'Classified as:','','');
		$this->DrawLine(0.7,'h',array(6.5,12));
		$this->leftText(0.2,1.6,'School:','','');
		$this->DrawLine(1.7,'h',array(6.5,12));
		$this->leftText(19,0.6,'School Year:','','');
		$this->DrawLine(0.7,'h',array(23.5,7));
		//data
		if(isset($g4tog6['hdr']['clas'])&&isset($g4tog6['hdr']['school'])&&isset($g4tog6['hdr']['sy'])&&isset($g4tog6['hdr']['pro'])){
			$this->leftText(7,0.6,$g4tog6['hdr']['clas'],'','');
			$this->leftText(7,1.5,$g4tog6['hdr']['school'],'','');
			$this->leftText(24,0.6,$g4tog6['hdr']['sy'],'','');	
			$this->leftText(8,15.7,$g4tog6['hdr']['pro']?$g4tog6['hdr']['pro']:$g4tog6['hdr']['ret'],'','');
		}
		$this->leftText(36.25,2.25,'Picture','','');
		$this->centerText(37.25,6.25,'Checked by','','');
		for($b=0;$b<count($g4tog6['dtl']);$b++){
			$this->leftText(0.2,4.7+($b*0.77),$g4tog6['dtl'][$b]['subject'],'','');
			$this->centerText(9,4.7+($b*0.77),$g4tog6['dtl'][$b]['period']['0'],'','');
			$this->centerText(13.85,4.7+($b*0.77),$g4tog6['dtl'][$b]['period']['1'],'','');
			$this->centerText(18.8,4.7+($b*0.77),$g4tog6['dtl'][$b]['period']['2'],'','');
			$this->centerText(23.65,4.7+($b*0.77),$g4tog6['dtl'][$b]['period']['3'],'','');
			$this->centerText(28.25,4.7+($b*0.77),$g4tog6['dtl'][$b]['final'],'','');
			$fi = $g4tog6['dtl'][$b]['final'];
			if($fi>75||$fi=='O'||$fi=='VG'||$fi=='G'||$fi=='S'||$fi=='NG'||$fi=='F'){
				$this->centerText(32.5,4.6+($b*0.77),'passed','','');
			}else{
				if($fi<75 || $fi=='NI'){
					$this->centerText(32.5,4.6+($b*0.77),'failed','','');
				}
			}
		}
		$this->leftText(0.2,13.7,'Days of School','','');
		$this->leftText(0.2,14.7,'Days Present','','');
		$this->leftText(0.2,15.7,'Promoted to / Retained in:','','');
	
		$this->DrawLine(15.8,'h',array(8,28));
		$this->GRID['font_size']=11;	
		$this->leftText(1.5,3.25,'Subjects','',$style='B');
		$this->GRID['font_size']=9;
		$this->centerText(9,3.85,'1','','');
		$this->centerText(13.85,3.85,'2','','');
		$this->centerText(18.8,3.85,'3','','');
		$this->centerText(23.65,3.85,'4','','');
		$this->centerText(17,3,'Periodic Ratings','',$style='B');
		$this->centerText(28.5,3,'Final','','');
		$this->centerText(28.5,3.75,'Grade','','');
		$this->centerText(32.5,3,'Action','','');
		$this->centerText(32.5,3.75,'Taken','','');
		$this->DrawLine(6.6,'v',array(2.25,9.6));
		$this->DrawLine(26.2,'v',array(2.25,9.6));
		$this->DrawLine(30.35,'v',array(2.25,9.6));
		$this->DrawLine(34.5,'v',array(2.25,9.6));
		$this->DrawLine(11.5,'v',array(3.23,8.65));
		$this->DrawLine(16.4,'v',array(3.23,8.65));
		$this->DrawLine(21.35,'v',array(3.23,8.65));
		$this->DrawLine(6.6,'v',array(12.15,2.85));
		$this->leftText(7.2,12.67,'June','','');
		$this->DrawLine(9.05,'v',array(12.15,2.85));
		$this->leftText(9.75,12.67,'July','','');
		$this->DrawLine(11.5,'v',array(12.15,2.85));
		$this->leftText(12.25,12.67,'Aug','','');
		$this->DrawLine(13.95,'v',array(12.15,2.85));
		$this->leftText(14.6,12.67,'Sept','','');
		$this->DrawLine(16.4,'v',array(12.15,2.85));
		$this->leftText(17.05,12.67,'Oct','','');
		$this->DrawLine(18.9,'v',array(12.15,2.85));
		$this->leftText(19.55,12.67,'Nov','','');
		$this->DrawLine(21.35,'v',array(12.15,2.85));
		$this->leftText(22,12.67,'Dec','','');
		$this->DrawLine(23.8,'v',array(12.15,2.85));
		$this->leftText(24.45,12.67,'Jan','','');
		$this->DrawLine(26.2,'v',array(12.15,2.85));
		$this->leftText(26.9,12.67,'Feb','','');
		$this->DrawLine(28.65,'v',array(12.15,2.85));
		$this->leftText(29.35,12.67,'Mar','','');
		$this->DrawLine(31.1,'v',array(12.15,2.85));
		$this->leftText(31.8,12.67,'Apr','','');
		$this->DrawLine(33.55,'v',array(12.15,2.85));
		$this->leftText(35.8,12.67,'TOTAL','','');
		$this->DrawLine(34.5,'v',array(0,2.25));
		//days
		$this->centerText(7.8,13.7,$g4tog6['att']['ds']['june'],'','');
		$this->centerText(10.3,13.7,$g4tog6['att']['ds']['july'],'','');
		$this->centerText(12.7,13.7,$g4tog6['att']['ds']['aug'],'','');
		$this->centerText(15.2,13.7,$g4tog6['att']['ds']['sep'],'','');
		$this->centerText(17.6,13.7,$g4tog6['att']['ds']['oct'],'','');
		$this->centerText(20.1,13.7,$g4tog6['att']['ds']['nov'],'','');
		$this->centerText(23,13.7,$g4tog6['att']['ds']['dec'],'','');
		$this->centerText(25,13.7,$g4tog6['att']['ds']['jan'],'','');
		$this->centerText(27.4,13.7,$g4tog6['att']['ds']['feb'],'','');
		$this->centerText(29.8,13.7,$g4tog6['att']['ds']['mar'],'','');
		$this->centerText(32.3,13.7,$g4tog6['att']['ds']['apr'],'','');			
		$this->centerText(7.8,14.8,$g4tog6['att']['dp']['june'],'','');
		$this->centerText(10.3,14.8,$g4tog6['att']['dp']['july'],'','');
		$this->centerText(12.7,14.8,$g4tog6['att']['dp']['aug'],'','');
		$this->centerText(15.2,14.8,$g4tog6['att']['dp']['sep'],'','');
		$this->centerText(17.6,14.8,$g4tog6['att']['dp']['oct'],'','');
		$this->centerText(20.1,14.8,$g4tog6['att']['dp']['nov'],'','');
		$this->centerText(23,14.8,$g4tog6['att']['dp']['dec'],'','');
		$this->centerText(25,14.8,$g4tog6['att']['dp']['jan'],'','');
		$this->centerText(27.4,14.8,$g4tog6['att']['dp']['feb'],'','');
		$this->centerText(29.8,14.8,$g4tog6['att']['dp']['mar'],'','');
		$this->centerText(32.3,14.8,$g4tog6['att']['dp']['apr'],'','');
		//total attendance
		$this->centerText(36.50,13.7,$g4tog6['att']['ds']['total'],'','');
		$this->centerText(36.50,14.8,$g4tog6['att']['dp']['total'],'','');
	}
	function ftr(){
		$metrics = array(
						'base_x' => 0.297,
						'base_y' => 9.75,
						'width' => 7.874,
						'height' => 1.378,
						'rows' =>7,
						'cols' =>40
					);
		$this->section($metrics);
		$this->GRID['font_size']=10;
		$this->leftText(17,1,'CERTIFICATION','','');
		$this->leftText(4,2,'I certify that this is true record of','','');
		$this->DrawLine(2.1,'h',array(14.3,15));
		$this->leftText(29.5,2,'. He / She  is  eligable for transfer','','');
		$this->leftText(0.2,2.8,'and admission to','','');
		$this->DrawLine(2.85,'h',array(5.8,10.2));
		$this->leftText(16.5,2.8,'and has no financial/property responsibilty in this school.','','');
		$this->leftText(0.2,4.2,'Valid only for','','');
		$this->DrawLine(4.3,'h',array(4.5,18));
		$this->leftText(30.5,4.2,'Date:','','');
		$this->DrawLine(4.3,'h',array(32.5,5));
		$this->leftText(29.5,6.8,'NERISSA M. GUILERMO','','');
		$this->leftText(32,7.5,'Principal','','');
		$this->GRID['font_size']=7;
		$this->leftText(4.5,6.5,'Not valid without','','');
		$this->leftText(5,7,'school seal','','');
	}
}