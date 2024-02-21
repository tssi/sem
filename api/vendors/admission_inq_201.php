<?php
require('admission_inq_f1c.php');
class AdmissionInquiryForm201 extends AdmissionInquiryForm1C{
	protected $_docName = '     Admission 201 Form 2 (AIF-201)';
	protected $_docTitle = 'APPLICAITON FOR ENROLLMENT';	
	function AdmissionInquiryForm201(){
		$this->showLines = !true;
		$this->FPDF(AdmissionInquiryForm201::$_orient, AdmissionInquiryForm201::$_unit,array(AdmissionInquiryForm201::$_width,AdmissionInquiryForm201::$_height));
		$this->createSheet();
	}
	function setupFields(){
		parent::setupFields();
		AdmissionInquiryForm201::$_fields[38]['label']='House Location Map (via scanned copy)';
		AdmissionInquiryForm201::$_fields[38]['no_box']=true;
		return AdmissionInquiryForm201::$_fields;

	}
	function setupData($fields,$student){
		$fields = parent::setupData($fields,$student);
		$inquiry = $student['Inquiry'];
		unset($fields[22]['checkbox']);
		$fields[22]['label']='';
		$fields[23]['data']=$inquiry['address'];
		$fields[24]['data']=$inquiry['barangay'];
		$fields[25]['data']=$inquiry['city'];
		$fields[26]['data']=$inquiry['province'];
		$fields[27]['data']=$inquiry['country'];
		$fields[28]['data']=$inquiry['gender'];
		$fields[29]['data']=date('d M Y', strtotime($inquiry['birthday']));
		$fields[30]['data']=$inquiry['citizenship'];
		$fields[31]['data']=$inquiry['religion'];

		// Father's Info
		$father_name = sprintf("%s, %s, %s",$inquiry['f_first_name'],$inquiry['f_middle_name'],$inquiry['f_last_name']);
		$fields[32]['data']=$father_name;
		$fields[33]['data']=$inquiry['f_mobile'];
		$fields[34]['data']=$inquiry['f_occupation'];

		// Mother's Info
		$mother_name = sprintf("%s, %s, %s",$inquiry['m_first_name'],$inquiry['m_middle_name'],$inquiry['m_last_name']);
		$fields[35]['data']=$mother_name;
		$fields[36]['data']=$inquiry['m_mobile'];
		$fields[37]['data']=$inquiry['m_occupation'];
		return $fields;
	}

	function footNotes(){
		
		$text = "
		**Terms and Conditions**
		By signing this form, I confirm and agree that:
		1. All information provided herein are true and correct, and I am responsible for my child's education and behaviors at LSEI.
		2. The terms and conditions stated below were explained to me properly, and that I understand and agree to each of the items indicated;
			     2.1. Terms and Conditions:
			          2.1.1. Reservation Fee paid, if any, is non-refundable.
		              2.1.2. Enrollment coverage at LSEI is for One School Year (SY).
		                   2.1.2.1. Refund, fees due in cases of withdrawal, transfer-out credentials, and the likes will be subject to the rules stated in
		                        DepEd Memorandum No. 88, Series of 2010, a copy of which was shown and explained to me.
		              2.1.3. LSEI has the right to withhold a student's credential(s), in case of non-compliance with the exit clearance implemented by
		                   the school. The credentials may include, but are not limited to, Official Report Card, ESC Certificate, and other DepEd
		                   Certifications issued by LSEI.
		3. The mode of instruction, schedule scheme, and transfer out procedures implemented by LSEI and duly reflected in the Student
		    Handbook, were clearly explained to me.
		4. I concur with all the school rules and regulations stated in the LSEI Student Handbook.";
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 1.8,
			'width'=> 8,
			'height'=> 9,
			'cols'=> 30,
			'rows'=> 55
		);
		$lnX = 0;
		$lnY = 51.5;
		$this->section($metrics);
		$this->GRID['font_size']=9;
		$this->complexFormat($lnX,$lnY,$text,0.3,0.5);
		$this->GRID['font_size']=10;
		$this->leftText(0.5,59.5,'Printed Name and Signature','','');
		$this->leftText(12,59.5,'Relationship','','');
		$this->leftText(19,59.5,'Date','','');
		$this->DrawLine(58.5,'h',array(0.5,10));
		$this->DrawLine(58.5,'h',array(12,6));
		$this->DrawLine(58.5,'h',array(19,6));
	}

	function complexFormat($x,$y,$text,$left=0.45,$right=0.5,$top=0){
		
		// Split the text into parts based on the **
		$parts = explode('**', $text);
		$cW = $this->GRID['cell_width'];
		$cH = $this->GRID['cell_height'];
		$cS = $this->GRID['font_size'];
		$cX = $cW * $x;
		$cY = $cH * $y;
		
		$this->SetXY($cX,$cY);
		$this->SetMargins($left,$top,$right);
		$this->Cell(0,$cH," ");
		foreach ($parts as $index => $part) {
		    if ($index % 2 === 0) {
		        // Regular font for non-bold parts
		        $this->Write($cH,$part);
		    } else {
		        // Bold font for parts between **
		        $this->SetFont('Arial', 'B', $cS);
		        $this->Write($cH, $part);
		        $this->SetFont('Arial', '', $cS); // Reset font to regular
		    }
		}
	}
}