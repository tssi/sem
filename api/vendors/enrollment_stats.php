<?php
require('vendors/fpdf17/formsheet.php');
class EnrollmentStatSheet extends Formsheet{
	protected static $_width = 11;
	protected static $_height = 8.5;
	protected static $_unit = 'in';
	protected static $_orient = 'L';	
	

	
	
	function EnrollmentStatSheet(){
		$this->showLines = !true;
		$this->FPDF(EnrollmentStatSheet::$_orient, EnrollmentStatSheet::$_unit,array(EnrollmentStatSheet::$_width,EnrollmentStatSheet::$_height));
		$this->createSheet();
	}

	function today_stat($today=null){
		//pr($today); exit();
		$metrics = array(
			'base_x'=> 0.5,
			'base_y'=> 1.5,
			'width'=> 7.5,
			'height'=> 0.7,
			'cols'=> 41,
			'rows'=> 4,	
		);
		$bxH = 3;
		$colW = 2.5;
		$this->section($metrics);
		$this->GRID['font_size']=12;
		$this->leftText(0,-5,'LakeShore Enrollment Report',1,'b');
		$this->GRID['font_size']=11;
		$this->leftText(0,-1,'Enrollment Report as of '.date("d-M-Y", strtotime($today['date'])),1,'b');
		

		$this->DrawBox(0,0,51, $bxH);
		$this->DrawNEWSLine(0,1,51,1,'S');
		//Date 
		// x, y, w, h, o
		$this->GRID['font_size']=8;
		$this->centerText(0,0.75,'Date',4);
		$this->DrawNEWSLine(0,0,4,$bxH,'E');
		//Day
		$this->centerText(4,0.75,'Day',4);
		$this->DrawNEWSLine(4,0,4,$bxH,'E');
		
		// Display Headers for each levels
		$x = 8;
		$tracks = array("ABM","STEM","TVL","HUMSS","GAS",'IRREG');
		$ctrT = count($tracks);
		//pr($tracks); exit();
		for($l=1;$l<=16;$l++){
			$label = $l;
			if($l<5){
				$label =  sprintf("Gr. %d",$l+6);
			}else{
				$label = $tracks[($l+1)%$ctrT];
			}
			$this->centerText($x,0.75,$label,$colW);
			$this->DrawNEWSLine($x,0,$colW,$bxH,'E');
			$x+=$colW;
		}
		//pr($x); exit();
		$GW =  $colW * $ctrT;
		// Grade 11
		$this->DrawBox(18,-1,$GW, 1);
		$this->centerText(18,-0.25,'Grade 11',$GW);
		// Grade 12
		$this->DrawBox(33,-1,$GW, 1);
		$this->centerText(33,-0.25,'Grade 12',$GW);
		// Total
		$this->centerText($x,0.75,'Total',$colW+0.5);

		// Display today enrollment stats
		//pr($today); exit();
		if($today){
			$this->GRID['font_size'] = 9.5;
			$this->centerText(0,2.25,date("d-M-y", strtotime($today['date'])),4);
			$this->centerText(4,2.25,$today['day'],4);

			$x = 8;
			foreach($today['levels'] as $l){
				$this->centerText($x,2.25,$l,$colW);
				$x+=$colW;
			}

			//$this->centerText($x,2.25,$today['total'],$colW+0.5);
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
		
		$lnH = 1.1;
		$colW = 2.5;
		$bxH = 4 * $lnH;

	
		$bxH =  (count($overall)+2) *$lnH;
		
		$this->section($metrics);
		$this->DrawBox(0,0,56, $bxH-1.25);
		$this->DrawNEWSLine(0,1,56,1,'S');
		$this->DrawNEWSLine(52,0,1.5,$bxH-1.25,'E');
		$this->DrawNEWSLine(49.5,0,1.5,$bxH-1.25,'E');
		$this->DrawNEWSLine(47.25,0,1.5,$bxH-1.25,'E');
		$this->GRID['font_size']=11;
		$this->leftText(0,-1,'Overall Enrollment',1,'b');

		//$this->DrawMultipleLines(1,$bxH-1,$lnH ,'h');

		//ED
		// x, y, w, h, o
		$this->GRID['font_size']=8;
		$this->centerText(-.25,0.75,'ED',2);
		$this->DrawNEWSLine(0,0,1.5,$bxH-1.25,'E');
		// Date
		$this->centerText(1.5,0.75,'Date',4);
		$this->DrawNEWSLine(2,0,3,$bxH-1.25,'E');
		// Day
		$this->centerText(4.75,0.75,'Day',2);
		$this->DrawNEWSLine(4.5,0,2,$bxH-1.25,'E');

		$x = 6.25;
		$tracks = array("ABM","STEM","HUMSS","TVL","GAS","IRREG");
		$ctrT = count($tracks);
		for($l=1;$l<=16;$l++){
			$label = $l;
			if($l<5){
				$label =  sprintf("Gr. %d",$l+6);
			}else{
				$label = $tracks[($l+1)%$ctrT];
			}
			$this->centerText($x,0.75,$label,$colW);
			$this->DrawNEWSLine($x,0,$colW,$bxH-1.25,'E');
			$x+=$colW;
		}

		$GW = $colW*$ctrT;
		// Grade 11
		$this->DrawBox(16.25,-1,$GW, 1);
		$this->centerText(16,-0.25,'Grade 11',$GW);
		// Grade 12
		$this->DrawBox(31.25,-1,$GW, 1);
		$this->centerText(31.25,-0.25,'Grade 12',$GW);
		// Previouse school year
		$this->DrawBox(48.75,-1,7.25, 1);
		$this->centerText(45,-0.25,'Previous SY',$GW);
		$this->centerText(42.5,.75,'HS',$GW);
		$this->centerText(45,.75,'SH',$GW);
		$this->centerText(47.5,.75,'Total',$GW);
		// Total
		$this->centerText($x,0.75,'Total',$colW+0.5);
		


		// Display today enrollment stats
		$cnt = 0;
		if($overall && $totals){
			$this->GRID['font_size'] = 8;
			$y =  2;
			foreach($overall  as $O):
				
				$cnt++;
				$this->centerText(-.25,$y-.1,$O['cnt'],2);
				$O['date'] = date("d-M-y", strtotime($O['date']));
				$this->centerText(1.25,$y-.1,$O['date'],4);
				$day = $O['day'][0];
				$this->centerText(4.75,$y-.1,$day,2);

				$x = 6.25;
				foreach($O['levels'] as $l){
					$this->centerText($x,$y-.1,$l,$colW);
					$x+=$colW;
				}

				//$this->centerText($x,$y-.1,$O['total'],$colW+0.5);
				$y+=$lnH;
				$this->DrawNEWSLine(0,$y-1,56,$y-1,'S');
			endforeach;
			$x = 6.25;
			$y = $bxH-0.5; 
			if(isset($totals['levels'])){
				$this->DrawNEWSLine($x,$y+.55,49.75,$y+.55,'S');
				$c=0;
				foreach($totals['levels'] as $l){
					$this->centerText($x,$y+.25,$l,$colW,'b');
					$x+=$colW;
					if($c<=16)
						$this->DrawNEWSLine($x-2.5,$y+.55,$colW,$bxH-1.25,'E');
					$c++;
				}
				$this->DrawNEWSLine(52,count($overall)+3.15,1.5,5.5,'E');
				$this->DrawNEWSLine(49.5,count($overall)+3.15,1.5,5.5,'E');
				$this->DrawNEWSLine(47.25,count($overall)+3.15,1.5,5.5,'E');
				$this->DrawNEWSLine(54.5,count($overall)+3.15,1.5,5.5,'E');
				//pr($totals); exit();
				//$this->centerText($x,$y+1,$totals['total'],$colW+0.5,'b');
						// Grand Total
				$this->SetFillColor(255,255,255);
				$this->DrawBox(0,$bxH-1.2,6.5, 1.24,'FD');
				$this->centerText(-.75,$bxH-.3,'Grand Total',8,'B');
			}
		}
		
	}
	
	
}

class EnrollmentListSheet extends Formsheet{
	protected static $_width = 11;
	protected static $_height = 8.5;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
	

	
	
	function EnrollmentListSheet(){
		$this->showLines = !true;
		$this->FPDF(EnrollmentListSheet::$_orient, EnrollmentListSheet::$_unit,array(EnrollmentListSheet::$_width,EnrollmentListSheet::$_height));
		$this->createSheet();
	}
	
	function enrollment_list($level,$data){
		//pr($data); exit();
		$metrics = array(
			'base_x'=> 0.5,
			'base_y'=> 1.5,
			'width'=> 7.5,
			'height'=> 0.7,
			'cols'=> 41,
			'rows'=> 4,	
		);
		$bxH = 3;
		$colW = 2.5;
		$this->section($metrics);
		$this->GRID['font_size']=12;
		//$this->leftText(0,-5,'LakeShore Enrollment List Report',1,'b');
		$this->GRID['font_size']=11;
		$this->leftText(10,-5,'Enrollment List Report for '.$level.' as of '.date("d-M-Y"),1,'b');
		$this->GRID['font_size']=9;
		$this->DrawBox(1,-1,7, 1);
		$this->centerText(4,-0.25,'Level','');
	
		$this->DrawBox(8,-1,5, 1);
		$this->centerText(10,-.25,'Sno','');
		
		$this->DrawBox(13,-1,16, 1);
		$this->centerText(18,-.25,'Name','');
	
		$this->DrawBox(29,-1,6, 1);
		$this->centerText(31.5,-.25,'Date Enrolled','');
		
		$this->DrawBox(35,-1,5, 1);
		$this->centerText(37,-.25,'OR','');
		
		$y = 1;
		
		foreach($data as $d){
			
			$d['transac_date'] = date("d-M-y", strtotime($d['transac_date']));
			$this->DrawBox(8,$y-1,5, 1);
			$this->leftText(8.5,$y-.2,$d['sno'],'');
			
			$this->DrawBox(13,$y-1,16, 1);
			$sname = mb_convert_case($d['name'], MB_CASE_TITLE, "UTF-8");
			$this->leftText(13.5,$y-.2,$d['cnt'].'.   '.utf8_decode($sname),'');
			//utf8_decode("name")
	
			$this->DrawBox(29,$y-1,6, 1);
			$this->leftText(29.5,$y-.2,$d['transac_date'],'');
			
			$this->DrawBox(35,$y-1,5, 1);
			$this->leftText(35.5,$y-.2,$d['ref_no'],'');
			$y++;
		}
		$this->DrawBox(1,0,7, count($data));
		$this->leftText(1.5,1,$level,'');
		
	}
	
	function enrollment_days($day,$data){
		//pr($day); 
		$day = date("d-F-Y", strtotime($day));
		$metrics = array(
			'base_x'=> 0.5,
			'base_y'=> 1.5,
			'width'=> 7.5,
			'height'=> 0.7,
			'cols'=> 41,
			'rows'=> 4,	
		);
		$bxH = 3;
		$colW = 2.5;
		$this->section($metrics);
		$this->GRID['font_size']=12;
		//$this->leftText(0,-5,'LakeShore Enrollment List Report',1,'b');
		$this->GRID['font_size']=11;
		$this->leftText(10,-5,'Enrollment List Report as of  '.$day,'');
		$this->GRID['font_size']=9;
		$this->DrawBox(1,-1,7, 1);
		$this->centerText(4,-0.25,'Date','');
	
		$this->DrawBox(8,-1,5, 1);
		$this->centerText(10,-.25,'Sno','');
		
		$this->DrawBox(13,-1,16, 1);
		$this->centerText(18,-.25,'Name','');
	
		$this->DrawBox(29,-1,6, 1);
		$this->centerText(31.5,-.25,'Year Level','');
		
		$this->DrawBox(35,-1,5, 1);
		$this->centerText(37,-.25,'OR','');
		
		$y = 1;
		
		foreach($data as $d){
			
			$this->DrawBox(8,$y-1,5, 1);
			$this->leftText(8.5,$y-.2,$d['sno'],'');
			
			$this->DrawBox(13,$y-1,16, 1);
			$this->leftText(13.5,$y-.2,$d['cnt'].'.   '.$d['name'],'');
		
			$this->DrawBox(29,$y-1,6, 1);
			$this->leftText(29.5,$y-.2,$d['level'],'');
			
			$this->DrawBox(35,$y-1,5, 1);
			$this->leftText(35.5,$y-.2,$d['ref_no'],'');
			$y++;
		}
		
		$this->DrawBox(1,0,7, count($data));
		$this->leftText(1.5,1,$day,'');
		
	}
}