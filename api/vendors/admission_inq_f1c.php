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
		$this->DrawImage(0.5,$y-1.8,2,0.7,__DIR__."/images/newlogo.png");
		$this->GRID['font_size']=10;
		$this->rightText(24,1,'Admission INQ Form 1C (AIF-F1C)',10.5,'b');
		$this->GRID['font_size']=9;
		
		$this->rightText(40,2.5,'School Year 2024 - 2025',10,'');
		$this->rightText(40,3.75,'Version 1.0',8.5,'i');
		$this->GRID['font_size']=14;
		$this->centerText(1,6,'APPLICATION FOR ADMISSION',50,'b');
		
		//$this->SetFillColor(0,156,72);
		//$this->DrawBox(19.5,4.75,29.5,1.5,'F');
		
	}

	function info($student=null){
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
		$note = '                           Kindly  WRITE  LEGIBLY IN  PRINT  when completing the form to ensure accurate  processing of your admission. Some information has already been filled up from your initial inquiry. If there are any corrections indicate the changes for updating.';
		$this->wrapText(0.5,-2.5,$note,30,'l',0.85);
		$this->leftText(0.66,-1.85,'INSTRUCTION:','','b');
		
		$metrics = array(
			'base_x'=> 0.4,
			'base_y'=> 1.8,
			'width'=> 7.75,
			'height'=> 8,
			'cols'=> 30,
			'rows'=> 55
		);
		$this->section($metrics);
		$this->GRID['font_size']=8;
		$this->leftText(24.5,0.5,'REF NO:',5,'');
		$this->GRID['font_size']=10;
		$this->leftText(26.5,0.5,'LSN234534',7,'b');

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
				array('label'=>'House No., Street Name, Subdivision','x'=>0,'y'=>17.5,'width'=>26),
				//array('label'=>'Subdivision','x'=>13,'y'=>17.5,'width'=>12),
				array('label'=>'Barangay','x'=>0,'y'=>20.5,'width'=>8.5),
				array('label'=>'City','x'=>9,'y'=>20.5,'width'=>8),
				array('label'=>'Province','x'=>18,'y'=>20.5,'width'=>8),
				array('label'=>'Country','x'=>27,'y'=>20.5,'width'=>2.5),
				array('label'=>'Guardian Name','x'=>0,'y'=>24,'width'=>8.5),
				array('label'=>'Relationship to Student','x'=>9,'y'=>24,'width'=>8),
				array('label'=>'Guardian Contact No.','x'=>18,'y'=>24,'width'=>8),
				array('label'=>'PERMANENT ADDRESS','x'=>0,'y'=>29,'width'=>8,'no_box'=>true),
				array('label'=>'Same as Current Address','x'=>8.75,'y'=>29,'width'=>2,'no_box'=>true, 'checkbox'=>true),
				array('label'=>'House No., Street Name, Subdivision','x'=>0,'y'=>30.5,'width'=>26),
				//array('label'=>'Subdivision','x'=>13,'y'=>30.5,'width'=>12),
				array('label'=>'Barangay','x'=>0,'y'=>33.5,'width'=>8.5),
				array('label'=>'City','x'=>9,'y'=>33.5,'width'=>8),
				array('label'=>'Province','x'=>18,'y'=>33.5,'width'=>8),
				array('label'=>'Country','x'=>27,'y'=>33.5,'width'=>2.5),
				array('label'=>'Gender','x'=>0,'y'=>37,'width'=>2.5),
				array('label'=>'Date of Birth','x'=>3,'y'=>37,'width'=>5.5,'watermark'=>'dd / mm / yyyy'),
				array('label'=>'Citizenship','x'=>9,'y'=>37,'width'=>8),
				array('label'=>'Religion','x'=>18,'y'=>37,'width'=>8),
				array('label'=>'Father\'s Name (First, Middle,Last)','x'=>0,'y'=>40.5,'width'=>8.5),
				array('label'=>'Mobile No.','x'=>9,'y'=>40.5,'width'=>8),
				array('label'=>'Occupation','x'=>18,'y'=>40.5,'width'=>8),
				
				array('label'=>'Mother\'s Name (First, Middle,Last)','x'=>0,'y'=>44,'width'=>8.5),
				array('label'=>'Mobile No.','x'=>9,'y'=>44,'width'=>8),
				array('label'=>'Occupation','x'=>18,'y'=>44,'width'=>8),
				
				array('label'=>'House Location Map (Sketch from the nearest landmark)','x'=>0,'y'=>47.5,'width'=>30,'height'=>12)

		);
		$fields[1]['data']='Juan';
		$fields[2]['data']='Andres';
		$fields[3]['data']='Dela Cruz';
		$fields[4]['data']='N/A';
		$fields[5]['data']='Grade 7';
		$fields[6]['data']='N/A';
		$fields[7]['data']='Simplified Academy';
		$fields[8]['data']='Lipa, Batangas';
		$fields[10]['data']='09171234567';
		$fields[11]['data']='**No info**';
		$fields[13]['data']='1234 Fe Street';
		$fields[14]['data']='New Hope';
		$fields[15]['data']='Lipa City';
		$fields[16]['data']='Batangas';
		$fields[17]['data']='PH';
		$fields[18]['data']='Juanito Dela Cruz';
		$fields[19]['data']='Father';
		$fields[20]['data']='09172223333';
		
		if($student):
			$inquiry = $student['Inquiry'];
			$yearLevel =  $student['YearLevel'];
			$program =  $student['Program'];

			$fields[1]['data']=$inquiry['first_name'];
			$fields[2]['data']=$inquiry['middle_name'];
			$fields[3]['data']=$inquiry['last_name'];
			$fields[4]['data']=$inquiry['suffix'];
			$fields[5]['data']=$yearLevel['description'];
			if(isset($program['name']))
				$fields[6]['data']=$program['name'];

			$fields[7]['data']=$inquiry['prev_school'];
			$fields[8]['data']=$inquiry['prev_school_address'];
			$fields[10]['data']=$inquiry['mobile'];
			$fields[11]['data']=$inquiry['landline'];
			$fields[13]['data']=$inquiry['c_address'];
			$fields[14]['data']=$inquiry['c_barangay'];
			$fields[15]['data']=$inquiry['c_city'];
			$fields[16]['data']=$inquiry['c_province'];
			$fields[17]['data']=$inquiry['c_country'];
			$fields[18]['data']='Juanito Dela Cruz';
			$fields[19]['data']='Father';
			$fields[20]['data']='09172223333';
		endif;

		foreach($fields as $fi=>$fv):
			if(isset($fv['data'])):
				if(trim($fv['data'])=='')
					$fv['data'] = 'N/A';
				$fields[$fi]['data'] = utf8_decode($fv['data']);
			endif;
		endforeach;
		$this->SetFillColor(0,156,72);
		$this->DrawBox(0,27,30,0.15,'F');
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

			if(isset($fld['data'])):
				$this->GRID['font_size']=10;
				$fd = $fld['data'];
				if(isset($fld['ix'])):
					$fx = $fld['ix'];
					$fy -=1.75;
				endif;
				$bxw =  $fw*1.3*$this->GRID['cell_width'];
				$this->fitText($fx+0.25,$fy+1.5,$fd,$bxw,'b');
			endif;
		endforeach;
	}
}