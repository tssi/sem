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
			'base_y'=> 1.3,
			'width'=> 8,
			'height'=> 9,
			'cols'=> 30,
			'rows'=> 55
		);
		//$this->_colorful = true;
		//$this->showLines = true;
		$this->section($metrics);

		$this->GRID['font_size']=9.5;
		$fields = array(
				array('label'=>'STUDENT NAME','x'=>0,'y'=>0.75,'width'=>8,'no_box'=>true),
				array('label'=>'First','x'=>0,'y'=>2,'width'=>8.5),
				array('label'=>'Middle','x'=>9,'y'=>2,'width'=>8),
				array('label'=>'Last','x'=>18,'y'=>2,'width'=>8),
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
		);

		foreach($fields as $fld):
			$fx =  $fld['x'];
			$fy =  $fld['y'];
			$fw =  $fld['width'];
			$fl =  $fld['label'];
			$fh =  1.75;
			$this->leftText($fx,$fy,$fl,$fw,'');
			if(!isset($fld['no_box'])):
				if(!isset($fld['display'])):
					$this->DrawBox($fx,$fy+0.25,$fw,$fh);
				else:
					$fix = $fld['ix'];
					$this->DrawBox($fix,$fy-1.2,$fw,$fh-0.25);
				endif;
			endif;
		endforeach;
	}
}