<?php
require('vendors/fpdf17/formsheet.php');
class AdmissionInquiryForm1C extends Formsheet{
	protected static $_width = 11;
	protected static $_height = 8.5;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
	
	
	function AdmissionInquiryForm1C(){
		$this->showLines = !true;
		$this->FPDF(AdmissionInquiryForm1C::$_orient, AdmissionInquiryForm1C::$_unit,array(AdmissionInquiryForm1C::$_width,AdmissionInquiryForm1C::$_height));
		$this->createSheet();
	}

	function hdr(){

		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 0.5,
			'width'=> 8,
			'height'=> 0.5,
			'cols'=> 50,
			'rows'=> 4,	
		);
		$this->section($metrics);
        $y=1;

        //$this->drawLine(32,'h',array(-2,42));
		if(isset($start))
            $y=$start;
		$this->DrawImage(0,$y-1.8,2,0.7,__DIR__."/images/newlogo.png");
		$this->GRID['font_size']=10;
		$this->rightText(24,1,'Admission INQ Form 1C (AIF-F1C)',10,'b');
		$this->GRID['font_size']=9;
		
		$this->leftText(39.25,2.5,'School Year 2024 - 2025',12,'');
		$this->leftText(43.75,3.75,'Version 1.0',12,'i');
		$this->GRID['font_size']=12;
		$this->centerText(0,6,'APPLICATION FOR ADMISSION',50,'b');
		
	}

	function info(){
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 1.8,
			'width'=> 8,
			'height'=> 9,
			'cols'=> 30,
			'rows'=> 55
		);
		//$this->_colorful = true;
		//$this->showLines = true;
		$this->section($metrics);
		$this->GRID['font_size']=9.5;
		$note = 'INSTRUCTION: Kindly  WRITE  LEGIBLY IN  PRINT  when completing the form to ensure accurate  processing of your admission. Some information has already been filled up from your initial inquiry. If there are any corrections indicate the changes for updating.';
		$this->wrapText(0.5,-2.5,$note,30,'l',0.85);
		
		$metrics = array(
			'base_x'=> 0.4,
			'base_y'=> 1.8,
			'width'=> 7.75,
			'height'=> 9,
			'cols'=> 30,
			'rows'=> 55
		);
		$this->section($metrics);

		$fields = array(
				array('label'=>'STUDENT NAME','x'=>0,'y'=>0.75,'width'=>8,'no_box'=>true),
				array('label'=>'First','x'=>0,'y'=>2,'width'=>8.5),
				array('label'=>'Middle','x'=>9,'y'=>2,'width'=>8.5),
				array('label'=>'Last','x'=>18,'y'=>2,'width'=>8.5),
				array('label'=>'Suffix','x'=>27,'y'=>2,'width'=>2.5),
				array('label'=>'Grade/Level:','x'=>0,'y'=>5.75,'width'=>8, 'display'=>'inline','ix'=>3.25),
				array('label'=>'Academic Track:','x'=>12,'y'=>5.75,'width'=>8, 'display'=>'inline','ix'=>16),
				array('label'=>'Name of Last School Attended:','x'=>0,'y'=>8,'width'=>22.25, 'display'=>'inline','ix'=>7.25),
				array('label'=>'Address of Previous School:','x'=>0,'y'=>10,'width'=>22.25, 'display'=>'inline','ix'=>7.25),
				array('label'=>'CONTACT NUMBER','x'=>0,'y'=>11.75,'width'=>8,'no_box'=>true),
				array('label'=>'Student Mobile No.','x'=>0,'y'=>13,'width'=>8),
				array('label'=>'Landline','x'=>9,'y'=>13,'width'=>8),
				array('label'=>'CURRENT ADDRESS','x'=>0,'y'=>16.25,'width'=>8,'no_box'=>true),
				array('label'=>'No and Street Name','x'=>0,'y'=>17.5,'width'=>12),
				array('label'=>'Subdivision','x'=>13,'y'=>17.5,'width'=>12),
				array('label'=>'Barangay','x'=>0,'y'=>20.5,'width'=>8.5),
				array('label'=>'City','x'=>9,'y'=>20.5,'width'=>8),
				array('label'=>'Province','x'=>18,'y'=>20.5,'width'=>8),
				array('label'=>'Country','x'=>27,'y'=>20.5,'width'=>2.5),
				array('label'=>'Guardian Name','x'=>0,'y'=>24,'width'=>8.5),
				array('label'=>'Relationship to Student','x'=>9,'y'=>24,'width'=>8),
				array('label'=>'Guardian Contact No.','x'=>18,'y'=>24,'width'=>8),
				array('label'=>'PERMANENT ADDRESS','x'=>0,'y'=>30,'width'=>8,'no_box'=>true),
				array('label'=>'Same as Current Address','x'=>9.75,'y'=>30,'width'=>2,'no_box'=>true, 'checkbox'=>true),
				array('label'=>'No and Street Name','x'=>0,'y'=>31.5,'width'=>12),
				array('label'=>'Subdivision','x'=>13,'y'=>31.5,'width'=>12),
				array('label'=>'Barangay','x'=>0,'y'=>34.5,'width'=>8.5),
				array('label'=>'City','x'=>9,'y'=>34.5,'width'=>8),
				array('label'=>'Province','x'=>18,'y'=>34.5,'width'=>8),
				array('label'=>'Country','x'=>27,'y'=>34.5,'width'=>2.5),
				array('label'=>'Gender','x'=>0,'y'=>38,'width'=>2.5),
				array('label'=>'Date of Birth','x'=>3,'y'=>38,'width'=>5.5,'watermark'=>'dd / mm / yyyy'),
				array('label'=>'Citizenship','x'=>9,'y'=>38,'width'=>8),
				array('label'=>'Religion','x'=>18,'y'=>38,'width'=>8),
				array('label'=>'House Location Map (Sketch from the nearest landmark)','x'=>0,'y'=>42,'width'=>30,'height'=>10)

		);
		$this->DrawBox(0,27.5,30,0.125,'F');
		foreach($fields as $fld):
			$fx =  $fld['x'];
			$fy =  $fld['y'];
			$fw =  $fld['width'];
			$fl =  $fld['label'];
			$fh =  1.75;
			if(isset($fld['height'])):
				$fh = $fld['height'];
			endif;
			$this->GRID['font_size']=9.5;
			$this->SetTextColor(0,0,0);
			$this->leftText($fx,$fy,$fl,$fw,'');
			if(!isset($fld['no_box'])):
				if(!isset($fld['display'])):
					$this->DrawBox($fx,$fy+0.25,$fw,$fh);
				else:
					$fix = $fld['ix'];
					$this->DrawBox($fix,$fy-1.2,$fw,$fh-0.25);
				endif;
				if(isset($fld['watermark'])):
					$wmk = $fld['watermark'];
					$this->GRID['font_size']=11;
					$this->SetTextColor(160,160,160);
					$this->centerText($fx,$fy+1.5,$wmk,$fw,'');
				endif;
			endif;
			if(isset($fld['checkbox'])):
				$this->DrawBox($fx-0.75,$fy-0.6,0.5,0.75);
			endif;
		endforeach;
	}
}