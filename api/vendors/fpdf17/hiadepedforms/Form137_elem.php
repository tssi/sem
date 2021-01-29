<?php
// STSN Form 137-A  Elementary Front Page
include('formsheet.php');
class STSNForm extends FormSheet{
	protected static  $_width = 8.5;
	protected static $_height = 13;
	protected static $_unit ='in';
	protected static $_orient ='P';
	protected static $_allot_subjects = 15;
	function STSNForm(){
		$this->showLines = !true;
		$this->FPDF(STSNForm::$_orient, STSNForm::$_unit,array(STSNForm::$_width,STSNForm::$_height));
		$this->createSheet();
		//$this->Image('../webroot/img/tmplt/form137_elem.jpg',0,0,8.5,11.5);
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
		$this->centerText(18.5,5,"ELEMENTARY PUPIL'S PERMANENT RECORD",'','');	
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
		$this->DrawLine(1.7,'h',array(7,18));	
		$this->leftText(0,2.3,'Date of Birth:','','');
		$this->DrawLine(2.5,'h',array(7,18));	
		$this->leftText(0,3.2,'Parent/Guardian:','','');	
		$this->DrawLine(3.4,'h',array(7,18));	
		$this->leftText(0,4,'Home Address:','','');	
		$this->DrawLine(4.2,'h',array(7,18));	
		$this->leftText(26.8,1.5,'Sex:','','');	
		$this->DrawLine(1.7,'h',array(33,10));		
		$this->leftText(26.8,2.3,'Place of Birth:','','');		
		$this->DrawLine(2.5,'h',array(33,10));	
		$this->leftText(26.8,3.2,'Occupation:','','');	
		$this->DrawLine(3.4,'h',array(33,10));	
		//data
		$this->leftText(7,1.5,$std_info['name'],'','');
		$this->leftText(7,2.4,$std_info['dob'],'','');
		$this->leftText(7,3.2,$std_info['par'],'','');
		$this->leftText(7,4.1,$std_info['add'],'','');
		$this->leftText(33,1.5,$std_info['gender'],'','');
		$this->leftText(33,2.4,$std_info['pob'],'','');
		$this->leftText(33,3.2,$std_info['occ'],'','');
	}
	function tableOne($preptog3){
	//print_r($preptog3);
		$metrics = array(
						'base_x' => 0.297,
						'base_y' => 1.870,
						'width' => 7.874,
						'height' => 1.440,
						'rows' =>7,
						'cols' =>40
					);
		$this->section($metrics);
		$this->Drawbox(0,0,40,5);
		$this->DrawLine(6.6,'v',array(1,4));
		$this->DrawLine(21.35,'v',array(1,4));
		$this->DrawLine(25.08,'v',array(1,4));
		$this->DrawLine(28.81,'v',array(1,4));
		$this->DrawLine(32.54,'v',array(1,4));
		$this->DrawLine(36.27,'v',array(1,4));
		$this->DrawLine(1,'h',array(0,40));
		$this->DrawMultipleLines(2.4,5,0.65,'h');
		$this->GRID['font_size']=9;
		$this->centerText(20,0.75,'Pre-Schoool','',$style='B');
		$this->leftText(1.5,1.8,'Schoool Year','','');
		//data
		for($i=0;$i<count($preptog3);$i++){
			$grade = $preptog3[$i]['grade'];
			if($grade=='N'||$grade=='K'||$grade=='P'){
				$this->leftText(1.5,2.95+($i*0.66),$preptog3[$i]['sy'],'','');
				$this->leftText(7,2.95+($i*0.66),$preptog3[$i]['school'],'','');
				$this->centerText(23,2.95+($i*0.66),$preptog3[$i]['grade'],'','');
				$this->centerText(27,2.95+($i*0.66),$preptog3[$i]['days'],'','');
				$this->centerText(30.5,2.95+($i*0.66),$preptog3[$i]['present'],'','');
				$this->centerText(34.6,2.95+($i*0.66),$preptog3[$i]['rating'],'','');
				$fi = $preptog3[$i]['rating'];
				if($fi!=0||$fi>=75||$fi=='O'||$fi=='VG'||$fi=='G'||$fi=='S'||$fi=='NG'||$fi=='F'){
					$this->centerText(38,2.9+($i*0.66),'passed','','');
				}else{
					if($fi<75 || $fi=='NI'){
						$this->centerText(38,2.95+($i*0.66),'failed','','');
					}
				}
			}
		}
		$this->leftText(13.4,1.8,'School','','');
		$this->leftText(22.25,1.6,'Grade','','');
		$this->leftText(22.3,2.2,'Level','','');
		$this->leftText(25.75,1.6,'Days of','','');
		$this->leftText(25.8,2.2,'School','','');
		$this->leftText(29.5,1.6,'Days of','','');
		$this->leftText(29.5,2.2,'Present','','');
		$this->leftText(33.6,1.6,'Final','','');
		$this->leftText(33.5,2.2,'Rating','','');
		$this->leftText(36.8,1.8,'Remarks','','');
	}
	function tableTwo($y,$g4tog6){
		$metrics = array(
						'base_x' => 0.297,
						'base_y' => 3+$y,
						'width' => 7.874,
						'height' => 3.145,
						'rows' =>16,
						'cols' =>40
					);
		$this->section($metrics);
		$this->Drawbox(0,0,40,16);
		$this->GRID['font_size']=9;
		$this->leftText(0.2,0.6,'Classified as:','','');	
		$this->DrawLine(0.7,'h',array(6.5,12));
		$this->leftText(0.2,1.4,'School:','','');	
		$this->DrawLine(1.5,'h',array(6.5,24.6));
		$this->leftText(19,0.6,'School Year:','','');	
		$this->DrawLine(0.7,'h',array(23.5,7));
		$this->leftText(34.6,2.5,'Picture','','');
		$this->Drawbox(33,0.5,5,5);
		$this->centerText(35.5,6.5,'Checked by:','','');
		//data
		$this->leftText(7,0.6,isset($g4tog6['hdr']['clas'])?$g4tog6['hdr']['clas']:'','','');
		$this->leftText(7,1.4,isset($g4tog6['hdr']['school'])?$g4tog6['hdr']['school']:'','','');
		$this->leftText(24,0.6,isset($g4tog6['hdr']['sy'])?$g4tog6['hdr']['sy']:'','','');
		//Periodic Rating
		$this->GRID['font_size']=11;	
		$this->leftText(1.5,2.75,'Subjects','',$style='B');
		$this->GRID['font_size']=9;
		$this->centerText(9,3.5,'1','','');
		$this->centerText(13.85,3.5,'2','','');
		$this->centerText(18.8,3.5,'3','','');
		$this->centerText(23.65,3.5,'4','','');
		$this->centerText(17,2.5,'Periodic Ratings','',$style='B');
		$this->centerText(28.25,2.5,'Final','','');
		$this->centerText(28.25,3.25,'Grade','','');
		//data
		/* echo "<pre>";
		print_r($g4tog6['dtl']);
		exit();  */
		for($b=0;$b<count($g4tog6['dtl']);$b++){
			$this->GRID['font_size']=8;	
			$this->fitText(0.2,4.3+($b*0.69),$g4tog6['dtl'][$b]['subject'],2,'');
			$this->GRID['font_size']=8;
			$this->centerText(9,4.3+($b*0.69),round($g4tog6['dtl'][$b]['period']['0']['lgrade']),'','');
			$this->centerText(13.85,4.3+($b*0.69),round($g4tog6['dtl'][$b]['period']['1']['lgrade']),'','');
			$this->centerText(18.8,4.3+($b*0.69),round($g4tog6['dtl'][$b]['period']['2']['lgrade']),'','');
			$this->centerText(23.65,4.3+($b*0.69),round($g4tog6['dtl'][$b]['period']['3']['lgrade']),'','');
			$this->centerText(28.25,4.3+($b*0.69),round($g4tog6['dtl'][$b]['final']['lgrade']),'','');
		} 
		$this->leftText(0.2,12,'GEN. AVERAGE','','');
		$this->DrawLine(1.75,'h',array(0,31.1));
		$this->DrawLine(2.75,'h',array(6.6,19.6));
		$this->DrawLine(3.75,'h',array(0,31.1));
		$this->DrawLine(4.4375,'h',array(0,31.1));
		$this->DrawLine(5.125,'h',array(0,31.1));
		$this->DrawLine(5.8125,'h',array(0,31.1));
		$this->DrawLine(6.5,'h',array(0,31.1));
		$this->DrawLine(7.1875,'h',array(0,31.1));
		$this->DrawLine(7.875,'h',array(0,31.1));
		$this->DrawLine(8.5625,'h',array(0,31.1));
		$this->DrawLine(9.25,'h',array(0,31.1));
		$this->DrawLine(9.9375,'h',array(0,31.1));
		$this->DrawLine(10.625,'h',array(0,31.1));
		$this->DrawLine(11.3125,'h',array(0,31.1));
		$this->DrawLine(12.15,'h',array(0,31.1));
		$this->DrawLine(6.6,'v',array(1.75,10.4)); 
		$this->DrawLine(11.5,'v',array(2.75,9.4));
		$this->DrawLine(16.4,'v',array(2.75,9.4));
		$this->DrawLine(21.35,'v',array(2.75,9.4));
		$this->DrawLine(26.2,'v',array(1.75,10.4));
		$this->DrawLine(31.1,'v',array(1.75,10.4));
		//Number days of school and days present
		$this->DrawLine(6.6,'v',array(12.3,2.7));
		$this->leftText(7.2,13,'June','','');		
		$this->DrawLine(9.05,'v',array(12.3,2.7));
		$this->leftText(9.75,13,'July','','');
		$this->DrawLine(11.5,'v',array(12.3,2.7));
		$this->leftText(12.25,13,'Aug','','');
		$this->DrawLine(13.95,'v',array(12.3,2.7));
		$this->leftText(14.6,13,'Sept','','');
		$this->DrawLine(16.4,'v',array(12.3,2.7));
		$this->leftText(17.05,13,'Oct','','');
		$this->DrawLine(18.9,'v',array(12.3,2.7));
		$this->leftText(19.55,13,'Nov','','');
		$this->DrawLine(21.35,'v',array(12.3,2.7));
		$this->leftText(22,13,'Dec','','');
		$this->DrawLine(23.9,'v',array(12.3,2.7));
		$this->leftText(24.45,13,'Jan','','');
		$this->DrawLine(26.2,'v',array(12.3,2.7));
		$this->leftText(26.9,13,'Feb','','');
		$this->DrawLine(28.65,'v',array(12.3,2.7));
		$this->leftText(29.35,13,'Mar','','');
		$this->DrawLine(31.1,'v',array(12.3,2.7));
		$this->leftText(31.8,13,'Apr','','');
		$this->DrawLine(33.55,'v',array(12.3,2.7));
		$this->leftText(35.8,13,'TOTAL','','');
		//attendance days of school
		 $this->centerText(7.8,13.9,$g4tog6['att']['ds']['june'],'','');
		$this->centerText(10.3,13.9,$g4tog6['att']['ds']['july'],'','');
		$this->centerText(12.7,13.9,$g4tog6['att']['ds']['aug'],'','');
		$this->centerText(15.2,13.9,$g4tog6['att']['ds']['sep'],'','');
		$this->centerText(17.6,13.9,$g4tog6['att']['ds']['oct'],'','');
		$this->centerText(20.1,13.9,$g4tog6['att']['ds']['nov'],'','');
		$this->centerText(23,13.9,$g4tog6['att']['ds']['dec'],'','');
		$this->centerText(25,13.9,$g4tog6['att']['ds']['jan'],'','');
		$this->centerText(27.4,13.9,$g4tog6['att']['ds']['feb'],'','');
		$this->centerText(29.8,13.9,$g4tog6['att']['ds']['mar'],'','');
		$this->centerText(32.3,13.9,$g4tog6['att']['ds']['apr'],'','');
		//attendance days present
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
		//total days of school & days present
		$this->leftText(35.8,13.9,$g4tog6['att']['ds']['total'],'','');
		$this->leftText(35.8,14.8,$g4tog6['att']['dp']['total'],'','');
		//data
		/* $this->leftText(8.2,15.7,$g4tog6['hdr']['pro']?$g4tog6['hdr']['pro']:$g4tog6['hdr']['ret'],'','');
		$this->leftText(34.5,15.7,$g4tog6['hdr']['total_y'],'','');  */
		$this->DrawMultipleLines(12.3,15.1,0.9,'h');
		$this->leftText(0.2,13.8,'Days of School','','');
		$this->leftText(0.2,14.8,'Days of present','','');
		$this->leftText(0.2,15.7,'Promoted to / Retained in:','','');		
		$this->DrawLine(15.8,'h',array(8,11));
		$this->leftText(21.5,15.7,'Total numbers of years in school to date:','','');		
		$this->DrawLine(15.8,'h',array(33.5,6));
	}
	function ftr(){
		$metrics = array(
						'base_x' => 0.325,
						'base_y' => 10.25,
						'width' => 7.874,
						'height' => 1.378,
						'rows' =>7,
						'cols' =>40
					);
		$this->section($metrics);
		$this->GRID['font_size']=10;
		$this->leftText(17,0,'CERTIFICATION','','');
		$this->leftText(3.5,2,'I  certify that  this is true record of','','');
		$this->DrawLine(2.1,'h',array(14.3,15));
		$this->leftText(29.5,2,'. He / She  is  eligable for transfer','','');
		$this->leftText(0.2,3,'and admission to','','');
		$this->DrawLine(3.1,'h',array(5.8,10.2));
		$this->leftText(16.5,3,'and has no financial / property responsibilty in this school.','','');
		$this->leftText(0.2,4.8,'Valid only for','','');
		$this->DrawLine(4.9,'h',array(4.5,18));
		$this->leftText(30.5,4.8,'Date:','','');
		$this->DrawLine(4.9,'h',array(32.5,7.5));
		$this->centerText(26,8.5,'Title. Lastname First Middle',15,'');
		$this->leftText(32,9.2,'Principal','','');
		$this->GRID['font_size']=7;
		$this->leftText(5,8.2,'Not valid without','','');
		$this->leftText(5.5,8.7,'school seal','','');
	}
}
?>