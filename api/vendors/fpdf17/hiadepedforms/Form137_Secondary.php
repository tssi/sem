<?php
// STSN Form 137-A  Elementary Front Page
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
				'base_y' => 0.197,
				'width' => 7.677,
				'height' => 0.984,
				'rows' =>5,
				'cols' =>39,
		);
		$this->section($metrics);
		$this->GRID['font_size']=6;
		$this->leftText(0,1,'DepEd Form 137 - A','','');	
		$this->GRID['font_size']=8;
		$this->leftText(30,1.5,'Copy of this record was sent to','','');	
		$this->leftText(30,2.1,'the principal of','','');
		$this->DrawLine(2.2,'h',array(33.8,5.2));	
		$this->leftText(32,2.7,'on','','');
		$this->DrawLine(2.8,'h',array(33,6));
		$this->DrawLine(3.5,'h',array(33,6));
		$this->leftText(35,4.1,'Principal','','');	
		$this->GRID['font_size']=10;
		$this->centerText(18.5,4.5,"SECONDARY PUPIL'S PERMANENT RECORD",'','');	
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
		$this->GRID['font_size']=9;
		$this->leftText(0,1,'Name:','','');
		$this->DrawLine(1,'h',array(2.5,22.5));
		$this->leftText(0,2,'Date of Birth:','','');
		$this->DrawLine(2,'h',array(4.5,16.5));	
		$this->leftText(0,3,'Home Address:','','');
		$this->DrawLine(3,'h',array(5,38));	
		$this->leftText(0,4,'Guardian:','','');
		$this->DrawLine(4,'h',array(3.5,21.5));	
		$this->leftText(0,5,'Elementary course completed:','','');
		$this->DrawLine(5,'h',array(9.5,15.5));	
		$this->leftText(0,6,'Total number of years in school to complete elementary course:','','');
		$this->DrawLine(6,'h',array(19.5,5.5));	
		$this->leftText(26.8,1,'Sex:','','');
		$this->DrawLine(1,'h',array(28.5,14.5));		
		$this->leftText(22,2,'Place of Birth:','','');	
		$this->DrawLine(2,'h',array(26.5,16.5));	
		$this->leftText(26.8,4,'Occupation:','','');
		$this->DrawLine(4,'h',array(31,12));		
		$this->leftText(26.8,5,'School Year:','','');
		$this->DrawLine(5,'h',array(31,12));		
		$this->leftText(26.8,6,'General Average:','','');
		$this->DrawLine(6,'h',array(32.5,10.5));		
		//data
		$this->leftText(3,0.90,$std_info['name'],'','');
		$this->leftText(5,1.90,$std_info['dob'],'','');
		$this->leftText(4,3.90,$std_info['par'],'','');
		$this->leftText(5.50,2.90,$std_info['add'],'','');
		$this->leftText(30,.90,$std_info['gender'],'','');
		$this->leftText(28,1.90,$std_info['pob'],'','');
		$this->leftText(31,3.9,$std_info['occ'],'','');
	}

	function tableOne($y,$x,$grade_pane){
		$metrics = array(
				'base_x' => 0.297,
				'base_y' => 2.25+$y,
				'width' => 7.874,
				'height' =>   4.427,
				'rows' =>23,
				'cols' =>40,
		);
		$this->section($metrics);
		$this->DrawBox(0,0,40,23.5);
		$this->GRID['font_size']=9;
		$this->leftText(0.2,1.1,'Classified as:','','');
		$this->DrawLine(1.2,'h',array(5,12));
		$this->leftText(0.2,2.4,'School:','','');
		$this->DrawLine(2.5,'h',array(3,26.5));
		$this->leftText(19,1.1,'School Year:','','');
		$this->DrawLine(1.2,'h',array(23.5,6));
		$this->DrawLine(33,'v',array(0,3.2));
		$this->DrawLine(37,'v',array(0,3.2));
		//data
		if(isset($grade_pane['hdr']['yr_lvl'])&&isset($grade_pane['hdr']['school'])&&isset($grade_pane['hdr']['sy'])){
			$this->leftText(5,1.1,$grade_pane['hdr']['yr_lvl'],'',$style='');
			$this->leftText(4,2.3,$grade_pane['hdr']['school'],'',$style='');
			$this->centerText(26.5,1.1,$grade_pane['hdr']['sy'],'',$style='');
		}
		//Periodic Rating
		$this->GRID['font_size']=11;	
		$this->leftText(2.5,4.25,'Subjects','',$style='B');
		$this->GRID['font_size']=9;
		$this->centerText(10.7,4.5+0.5,'1','','');
		$this->centerText(15.25,4.5+0.5,'2','','');
		$this->centerText(19.7,4.5+0.5,'3','','');
		$this->centerText(24.2,4.5+0.5,'4','','');
		$this->centerText(17,3.5+0.5,'Periodic Ratings','',$style='B');
		$this->centerText(28.8,3.7+0.5,'FINAL','','');
		$this->centerText(28.8,4.45+0.5,'RATING','','');
		$this->centerText(33.3,3.7+0.5,'ACTION','','');
		$this->centerText(33.3,4.45+0.5,'TAKEN','','');
		$this->centerText(37.8,3.57+0.5,'UNITS','','');
		$this->centerText(37.8,4.45+0.5,'EARNED','','');
		//data
		if(isset($grade_pane)){
			for($i=0;$i<count($grade_pane['dtl']);$i++){
				$this->leftText(0.5,5.84+($i*.69),$grade_pane['dtl'][$i]['subject'],'','');
				$this->centerText(10.5,5.84+($i*.69),$grade_pane['dtl'][$i]['fr'],'','');
				$this->centerText(15.25,5.84+($i*.69),$grade_pane['dtl'][$i]['se'],'','');
				$this->centerText(19.7,5.84+($i*.69),$grade_pane['dtl'][$i]['th'],'','');
				$this->centerText(24.2,5.84+($i*.69),$grade_pane['dtl'][$i]['fo'],'','');
				$this->centerText(29,5.84+($i*.69),$grade_pane['dtl'][$i]['cs_ave'],'','');
				$this->centerText(37.8,5.84+($i*.69),$grade_pane['dtl'][$i]['unit'],'','');
				$this->centerText(33.3,5.84+($i*.69),$grade_pane['dtl'][$i]['action'],'','');
			}
		}
		$this->leftText(0.2,13+0.5,'GEN. AVERAGE','','');
		$this->DrawLine(2.75+0.5,'h');
		$this->DrawLine(4.25,'h',array(8.5,18));
		$this->DrawLine(4.75+0.5,'h');	//0.6875 interval start here
		$this->DrawLine(5.4375+0.5,'h');
		$this->DrawLine(6.125+0.5,'h');
		$this->DrawLine(6.8125+0.5,'h');
		$this->DrawLine(7.5+0.5,'h');
		$this->DrawLine(8.1875+0.5,'h');
		$this->DrawLine(8.875+0.5,'h');
		$this->DrawLine(9.5625+0.5,'h');
		$this->DrawLine(10.25+0.5,'h');
		$this->DrawLine(10.9375+0.5,'h');
		$this->DrawLine(11.625+0.5,'h');
		$this->DrawLine(12.3125+0.5,'h');
		$this->DrawLine(13.15+0.5,'h');
		$this->DrawLine(8.5,'v',array(2.75+0.5,10.4)); //4.5
		$this->DrawLine(13,'v',array(3.75+0.5,9.4));
		$this->DrawLine(17.5,'v',array(3.75+0.5,9.4));
		$this->DrawLine(22,'v',array(3.75+0.5,9.4));
		$this->DrawLine(26.5,'v',array(2.75+0.5,10.4));
		$this->DrawLine(31,'v',array(2.75+0.5,10.4));
		$this->DrawLine(35.5,'v',array(2.75+0.5,10.4));
		$this->DrawLine(6.6,'v',array(13.8,2.7));
		$this->leftText(7.2,14.5,'June','','');
		$this->DrawLine(9.05,'v',array(13.8,2.7));
		$this->leftText(9.75,14.5,'July','','');
		$this->DrawLine(11.5,'v',array(13.8,2.7));
		$this->leftText(12.25,14.5,'Aug','','');
		$this->DrawLine(13.95,'v',array(13.8,2.7));
		$this->leftText(14.6,14.5,'Sept','','');
		$this->DrawLine(16.4,'v',array(13.8,2.7));
		$this->leftText(17.05,14.5,'Oct','','');
		$this->DrawLine(18.9,'v',array(13.8,2.7));
		$this->leftText(19.55,14.5,'Nov','','');
		$this->DrawLine(21.35,'v',array(13.8,2.7));
		$this->leftText(22,14.5,'Dec','','');
		$this->DrawLine(23.9,'v',array(13.8,2.7));
		$this->leftText(24.45,14.5,'Jan','','');
		$this->DrawLine(26.2,'v',array(13.8,2.7));
		$this->leftText(26.9,14.5,'Feb','','');
		$this->DrawLine(28.65,'v',array(13.8,2.7));
		$this->leftText(29.35,14.5,'Mar','','');
		$this->DrawLine(31.1,'v',array(13.8,2.7));
		$this->leftText(31.8,14.5,'Apr','','');
		$this->DrawLine(33.55,'v',array(13.8,2.7));
		$this->leftText(35.8,14.5,'TOTAL','','');
		$this->DrawMultipleLines(13.8,16.6,0.9,'h');
		$this->leftText(0.2,15.4,'Days of School','','');
		$this->leftText(0.2,16.3,'Days Present','','');
		//days present && days of school
		/* echo "<pre>";
		print_r($grade_pane); */
		if(isset($grade_pane['foot']['ds'])&&isset($grade_pane['foot']['dp'])){
			$this->centerText(8,15.4,$grade_pane['foot']['ds']['june'],'','');
			$this->centerText(8,16.3,$grade_pane['foot']['dp']['june'],'','');
			$this->centerText(10.3,15.4,$grade_pane['foot']['ds']['july'],'','');
			$this->centerText(10.3,16.3,$grade_pane['foot']['dp']['july'],'','');
			$this->centerText(12.7,15.4,$grade_pane['foot']['ds']['aug'],'','');
			$this->centerText(12.7,16.3,$grade_pane['foot']['dp']['aug'],'','');
			$this->centerText(15.2,15.4,$grade_pane['foot']['ds']['sep'],'','');
			$this->centerText(15.2,16.3,$grade_pane['foot']['dp']['sep'],'','');
			$this->centerText(17.70,15.4,$grade_pane['foot']['ds']['oct'],'','');
			$this->centerText(17.70,16.3,$grade_pane['foot']['dp']['oct'],'','');
			$this->centerText(20.1,15.4,$grade_pane['foot']['ds']['nov'],'','');
			$this->centerText(20.1,16.3,$grade_pane['foot']['dp']['nov'],'','');
			$this->centerText(22.70,15.4,$grade_pane['foot']['ds']['dec'],'','');
			$this->centerText(22.70,16.3,$grade_pane['foot']['dp']['dec'],'','');
			$this->centerText(25,15.4,$grade_pane['foot']['ds']['jan'],'','');
			$this->centerText(25,16.3,$grade_pane['foot']['dp']['jan'],'','');
			$this->centerText(27.40,15.4,$grade_pane['foot']['ds']['feb'],'','');
			$this->centerText(27.40,16.3,$grade_pane['foot']['dp']['feb'],'','');
			$this->centerText(29.80,15.4,$grade_pane['foot']['ds']['mar'],'','');
			$this->centerText(29.80,16.3,$grade_pane['foot']['dp']['mar'],'','');
			$this->centerText(32.30,15.4,$grade_pane['foot']['ds']['apr'],'','');
			$this->centerText(32.30,16.3,$grade_pane['foot']['dp']['apr'],'','');
			//total of attendace
			$this->centerText(36.60,15.4,$grade_pane['foot']['ds']['total'],'','');
			$this->centerText(36.60,16.3,$grade_pane['foot']['dp']['total'],'','');
		}
		$this->leftText(0.2,16.7+0.5,'Has advance units in','','');
		$this->DrawLine(16.8+0.5,'h',array(8,31));
		$this->leftText(0.2,17.4+0.5,'Lacks unit in','','');
		$this->DrawLine(17.5+0.5,'h',array(8,31));	
		$this->leftText(0.2,18.2+0.5,'To be classified as','','');
		$this->DrawLine(18.3+0.5,'h',array(8,11));
		$this->leftText(21.5,18.2+0.5,'Total number of years in school to date','','');
		$this->DrawLine(18.3+0.5,'h',array(33,6));
		$this->DrawLine(19,'h');
		$this->DrawLine(19.1,'h');
		$this->leftText(0.2,19.7,'SUMMER CLASS','',$style='B');
		$this->leftText(7,19.7,'School:','','');
		$this->DrawLine(19.8,'h',array(9.5,16));
		$this->leftText(28,19.7,'School Year:','','');
		$this->DrawLine(19.8,'h',array(32,6));
		$this->leftText(5.5,20.7,'SUBJECTS','','');
		$this->leftText(15,20.7,'Final Grade','','');
		$this->leftText(20,20.7,'Action Taken','','');
		$this->leftText(25,20.7,'Credits Earned','','');
		$this->leftText(34,20.7,'Days of School','','');
		$this->leftText(30.8,21.6,'April','','');
		$this->leftText(30.9,22.5,'May','','');
		$this->leftText(30.5,23.4,'TOTAL','','');
		$this->DrawMultipleLines(20,23.5,0.9,'h');
		$this->DrawLine(14,'v',array(20,3.5));
		$this->DrawLine(19,'v',array(20,3.5));
		$this->DrawLine(24,'v',array(20,3.5));
		$this->DrawLine(30,'v',array(20,3.5));
		$this->DrawLine(33,'v',array(20,3.5));
	}
	function ftr(){
		$metrics = array(
						'base_x' => 0.297,
						'base_y' => 9.5,
						'width' => 7.874,
						'height' => 1.378,
						'rows' =>7,
						'cols' =>40
					);
		$this->section($metrics);
		$this->GRID['font_size']=10;
		$this->leftText(17,1,'TRANSFER OF ELIGIBILITY','','');
		$this->leftText(4,2,'I certify that this is true record of','','');
		$this->DrawLine(2.1,'h',array(14.3,15));
		$this->leftText(29.5,2,'. He / She  is  eligable on this','','');
		$this->leftText(0.2,2.8,'day of','','');
		$this->DrawLine(2.85,'h',array(3,7));
		$this->leftText(10.5,2.8,'for admission to','','');
		$this->DrawLine(2.85,'h',array(16,6));
		$this->leftText(22.5,2.8,'year highschool/college. He/She has no financial or','','');
		$this->leftText(0.2,3.6,'material responsibilty in this school.','','');

		$this->leftText(29.5,6.8,'NERISSA M. GUILERMO','','');
		$this->leftText(32,7.5,'Principal','','');
		$this->GRID['font_size']=7;
		$this->leftText(4.5,6.5,'Not valid without','','');
		$this->leftText(4.6,7,'school dry seal','','');
	}
}