<?php
require('vendors/fpdf17/formsheet.php');
class EnrollmentStatSheet extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 11;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
	

	
	
	function EnrollmentStatSheet(){
		$this->showLines = !true;
		$this->FPDF(EnrollmentStatSheet::$_orient, EnrollmentStatSheet::$_unit,array(EnrollmentStatSheet::$_width,EnrollmentStatSheet::$_height));
		$this->createSheet();
	}

	function today_stat($today=null){
		$metrics = array(
			'base_x'=> 0.5,
			'base_y'=> 1.5,
			'width'=> 7.5,
			'height'=> 0.7,
			'cols'=> 41,
			'rows'=> 4,	
		);
		$bxH = 3;
		$this->section($metrics);
		$this->GRID['font_size']=12;
		$this->leftText(0,-5,'LakeShore Enrollment Report',1,'b');
		$this->GRID['font_size']=11;
		$this->leftText(0,-1,'Enrollment Report as of '.$today['date'],1,'b');
		

		$this->DrawBox(0,0,41, $bxH);
		$this->DrawNEWSLine(0,1,41,1,'S');
		//Date 
		// x, y, w, h, o
		$this->GRID['font_size']=9;
		$this->centerText(0,0.75,'Date',4);
		$this->DrawNEWSLine(0,0,4,$bxH,'E');
		//Day
		$this->centerText(4,0.75,'Day',4);
		$this->DrawNEWSLine(4,0,4,$bxH,'E');
		
		// Display Headers for each levels
		$x = 8;
		$tracks = array("STEM","HUMSS","TVL");
		for($l=1;$l<=10;$l++){
			$label = $l;
			if($l<5){
				$label =  sprintf("Gr. %d",$l+6);
			}else{
				$label = $tracks[($l+1)%3];
			}
			$this->centerText($x,0.75,$label,3);
			$this->DrawNEWSLine($x,0,3,$bxH,'E');
			$x+=3;
		}

		// Grade 11
		$this->DrawBox(20,-1,9, 1);
		$this->centerText(20,-0.25,'Grade 11',9);
		// Grade 12
		$this->DrawBox(29,-1,9, 1);
		$this->centerText(29,-0.25,'Grade 12',9);
		// Total
		$this->centerText($x,0.75,'Total',3);

		// Display today enrollment stats
		if($today){
			$this->GRID['font_size'] = 9.5;
			$this->centerText(0,2.25,$today['date'],4);
			$this->centerText(4,2.25,$today['day'],4);

			$x = 8;
			foreach($today['levels'] as $l){
				$this->centerText($x,2.25,$l,3);
				$x+=3;
			}

			$this->centerText($x,2.25,$today['total'],3);
		}
	}

	function overall_stat($overall=null,$totals = null){

		$metrics = array(
			'base_x'=> 0.5,
			'base_y'=> 3,
			'width'=> 7.5,
			'height'=> 0.7,
			'cols'=> 41,
			'rows'=> 4,	
		);
		// Number of rows allowed
		
		$lnH = 1.25;
		$bxH = 4 * $lnH;

		if(count($overall)>3)
			$bxH =  (count($overall)+2) *$lnH;
		$this->section($metrics);
		$this->DrawBox(0,0,41, $bxH);
		$this->DrawNEWSLine(0,1,41,1,'S');
		$this->GRID['font_size']=11;
		$this->leftText(0,-1,'Overall Enrollment',1,'b');

		$this->DrawMultipleLines(1,$bxH-1,$lnH ,'h');

		//ED
		// x, y, w, h, o
		$this->GRID['font_size']=9;
		$this->centerText(0,0.75,'ED',2);
		$this->DrawNEWSLine(0,0,2,$bxH,'E');
		// Date
		$this->centerText(2,0.75,'Date',4);
		$this->DrawNEWSLine(2,0,4,$bxH,'E');
		// Day
		$this->centerText(6,0.75,'Day',2);
		$this->DrawNEWSLine(6,0,2,$bxH,'E');

		$x = 8;
		$tracks = array("STEM","HUMSS","TVL");
		for($l=1;$l<=10;$l++){
			$label = $l;
			if($l<5){
				$label =  sprintf("Gr. %d",$l+6);
			}else{
				$label = $tracks[($l+1)%3];
			}
			$this->centerText($x,0.75,$label,3);
			$this->DrawNEWSLine($x,0,3,$bxH,'E');
			$x+=3;
		}
		// Grade 11
		$this->DrawBox(20,-1,9, 1);
		$this->centerText(20,-0.25,'Grade 11',9);
		// Grade 12
		$this->DrawBox(29,-1,9, 1);
		$this->centerText(29,-0.25,'Grade 12',9);
		// Total
		$this->centerText($x,0.75,'Total',3);
		// Grand Total
		$this->SetFillColor(255,255,255);
		$this->DrawBox(0,$bxH-1.5,8, 1.5,'FD');
		$this->centerText(0,$bxH-0.5,'Grade Total',8,'B');


		// Display today enrollment stats
		$cnt = 0;
		if($overall && $totals){
			$this->GRID['font_size'] = 9.5;
			$y =  2;
			foreach($overall  as $O):
				$cnt++;
				$this->centerText(0,$y,$cnt,2);
				$this->centerText(2,$y,$O['date'],4);
				$day = $O['day'][0];
				$this->centerText(6,$y,$day,2);

				$x = 8;
				foreach($O['levels'] as $l){
					$this->centerText($x,$y,$l,3);
					$x+=3;
				}

				$this->centerText($x,$y,$O['total'],3);
				$y+=$lnH;
			endforeach;
			$x = 8;
			$y = $bxH-0.5; 
			foreach($totals['levels'] as $l){
				$this->centerText($x,$y,$l,3,'b');
				$x+=3;
			}

			$this->centerText($x,$y,$totals['total'],3,'b');
		}

	}
}