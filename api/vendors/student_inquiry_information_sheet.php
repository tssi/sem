<?php
require('vendors/fpdf17/formsheet.php');
class InquiryInformationSheet extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 11;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
	protected static $curr_page = 1;
	protected static $page_count;
	protected static $ctr = 1.8;
	protected static $grand_total = 0;
	
	function InquiryInformationSheet(){
		$this->showLines = !true;
		$this->FPDF(InquiryInformationSheet::$_orient, InquiryInformationSheet::$_unit,array(InquiryInformationSheet::$_width,InquiryInformationSheet::$_height));
		$this->createSheet();
	}
	
	function info($data=null){
		$inquiry = null;
		$yearlv = null;
		$prog = null;
		$address = null;
		$guardian = null;
		$studentName = null;
		if(isset($data['Inquiry']))
			$inquiry=$data['Inquiry'];
		if(isset($data['YearLevel']))
			$yearlv=$data['YearLevel'];
		if(isset($data['Program']))
			$prog=$data['Program'];
		if($inquiry):
			foreach($inquiry as $key=>$value){
				$inquiry[$key] = utf8_decode($value);
			}
			$address = array($inquiry['address'],$inquiry['barangay'],$inquiry['city'],$inquiry['province'],$inquiry['country']);
			$address =(implode(' ', $address));

			$guardian = array($inquiry['g_first_name'],$inquiry['g_middle_name'],$inquiry['g_last_name'],$inquiry['g_suffix']);
			$guardian = (implode(' ', $guardian));

			$studentName = array($inquiry['first_name'],$inquiry['middle_name'],$inquiry['last_name'],$inquiry['suffix']);
			$studentName = (implode(' ', $studentName));

			
		endif;
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.5,
			'base_y'=> 0.25,
			'width'=> 7.5,
			'height'=> 0.7,
			'cols'=> 41,
			'rows'=> 4,	
		);
		$this->section($metrics);
		
		$y=1;
		$this->DrawImage(9.5,0,0.7,0.7,__DIR__."/lakeshore.png");
		$this->GRID['font_size']=10;
		$this->centerText(0,$y++,'Lake Shore Educational Institution',41,'b');
		$this->GRID['font_size']=8;
		$this->centerText(0,$y,utf8_decode('Canlalay, Biñan City, Laguna'),41,'');
		$y+=1.5;
		$this->GRID['font_size']=10;
		$this->centerText(0,$y++,'Student Inquiry Information Sheet',41,'b');
		
		$y+=1.5;
		$this->GRID['font_size']=8;
		$this->leftText(31,$y-2.5,'Ref No.','','');
		$this->leftText(34,$y-2.5,$inquiry['id'],'','b');
		$this->leftText(0,$y++,'Name','','b');
		
		$this->leftText(1,$y,'Last Name','','i');
		$this->leftText(11,$y,'First Name','','i');
		$this->leftText(21,$y,'Middle Name','','i');
		$this->leftText(31,$y,'Extension','','i');
		$y++;
		if($inquiry):
			if(!$inquiry['middle_name']) 
				$inquiry['middle_name']='N/A';
			if(!$inquiry['suffix']) 
				$inquiry['suffix']='N/A';

			$this->leftText(1,$y,$inquiry['last_name'],'','b');
			$this->leftText(11,$y,$inquiry['first_name'],'','b');
			$this->leftText(21,$y,$inquiry['middle_name'],'','b');
			$this->leftText(31,$y,$inquiry['suffix'],'','b');

		endif;
		$y+=2;
		$this->leftText(0,$y++,'BASIC INFORMATION','','b');
		
		$this->leftText(1,$y,'Gender','','i');
		$this->leftText(6,$y,'Civil Status','','i');
		$this->leftText(11,$y,'Date of Birth','','i');
		$this->leftText(19,$y,'Place of Birth','','i');
		$this->leftText(33,$y,'Citizenship','','i');
		$y++;
		if($inquiry):
			$inquiry['gender'] = $inquiry['gender']=='M'?'Male':'Female';
			$inquiry['birthday'] = date('d M Y', strtotime($inquiry['birthday']));
			$this->leftText(1,$y,$inquiry['gender'],'','b');
			$this->leftText(6,$y,$inquiry['civil_status'],'','b');
			$this->leftText(11,$y,$inquiry['birthday'],'','b');
			$this->leftText(19,$y,$inquiry['birthplace'],'','b');
			$this->leftText(33,$y,$inquiry['citizenship'],'','b');
		endif;
		$y+=1.5;
		$this->leftText(1,$y,'Mobile No.','','i');
		$this->leftText(11,$y,'Landline No.','','i');
		$y++;
		if($inquiry):
			$this->leftText(1,$y,$inquiry['mobile'],'','b');
			$this->leftText(11,$y,$inquiry['landline'],'','b');
		endif;
		$y+=1.5;
		$this->leftText(1,$y,'Address','','i');
		$y++;
		if($address):
			
			$this->leftText(1,$y,$address,'','b');
		endif;
		$y+=2;
		$this->leftText(0,$y++,'ACADEMICS','','b');
		$this->leftText(1,$y,'Entry Level: ','','i');
		$this->leftText(11,$y,'Last School Attended:','','i');
		if($inquiry&& $yearlv):
			$yrLvStr =$yearlv['description'];
			if($prog)
				$yrLvStr .= ' / '.$prog['description'];
		$this->leftText(5,$y,$yrLvStr,'','b');
		$this->leftText(18,$y,$inquiry['prev_school'],'','b');
		endif;
		$y=22;
		$this->leftText(0,$y++,'GUARDIAN INFORMATION','','b');
		$y=23;
		$this->leftText(1,$y++,'Name of Guardian:','','i');
		$this->rightText(6.1,$y++,'Address:','','i');
		$this->rightText(6.1,$y++,'Contact No:','','i');
		$this->rightText(6.1,$y++,'Occupation:','','i');
		$this->rightText(6.1,$y++,'Relation:','','i');
		
		$y=23;
		if($inquiry && $address && $guardian):
		$this->leftText(6.5,$y++,$guardian,'','b');
		$this->leftText(6.5,$y++,$address,'','b');
		$this->leftText(6.5,$y++,$inquiry['g_contact_no'],'','b');
		$this->leftText(6.5,$y++,$inquiry['g_occupation'],'','b');
		$this->leftText(6.5,$y++,$inquiry['g_rel'],'','b');
		endif;

		$dvdr ='-------------------------------------------------------------------';
		$this->leftText(0,$y,$dvdr.$dvdr.$dvdr,'','');

		$y+=1.5;
		$this->leftText(0,$y,'Please check if all the information above is accurate. Thank you for your interest in Lake Shore Educational Institution.  ','','i');
		$y+=2;
		$this->centerText(0,$y,'TERMS AND CONDITIONS',41,'b');
		
		$y+=1.5;
		$this->leftText(1,$y,'1.  Your Reference Number is ','','');
		$this->leftText(9.5,$y++,$inquiry['id'].'.','','b');
		$this->leftText(1,$y++,'2.  Reservation for enrollment for School Year 2021 - 2022 is from March 5, 2021 to June 15, 2021.','','');
		$this->leftText(1,$y++,'3.  Reservation fee is non-refundable.','','');
		$this->leftText(1,$y++,'4.  Reservation fee is automatically deducted from the school fees for School Year 2021 - 2022.','','');
		$this->leftText(1,$y++,'5.  Lake Shore Educational Institution will process the application of the student\'s Education Service Contracting (ESC) grant upon payment of the','','');
		$this->leftText(1,$y++,'    reservation fee.','','');
		$this->leftText(1,$y++,'6.  ESC subsidy is subject to Private Education Assistance Committee (PEAC) approval.','','');
		$this->leftText(1,$y++,'7.  Payment of reservation fee does not guarantee approval of ESC subsidy.','','');
		$this->leftText(1,$y++,'8.  Lake Shore Educational Institution is not obliged to discuss reason(s) for the disapproval of ESC grant by PEAC. ','','');
		$this->leftText(1,$y++,'9.  Application of ESC grant is on a first come first serve basis.  ','','');
		$this->leftText(0.7,$y++,'10.  ESC is applicable only to NEW and incoming Grade 7 students only.','','');
		$this->leftText(0.7,$y++,'11.  Approved ESC grant for Junior High School or presentation of QVR Voucher for Senior High School is deducted immediately from the assessed','','');
		$this->leftText(0.7,$y++,'       school fees.','','');
		$this->leftText(0.7,$y++,'12.  Students with approved ESC must enroll on or before July 30, 2021.  Unless there is prior written arrangement to enroll on a later date, Lake Shore','','');
		$this->leftText(0.7,$y,'       will be constraint to cancel or transfer the ESC grant to another applicant. ','','');
		  
		$y+=2;
		$this->leftText(0.5,$y++,'I certify that I have read and carefully understand the above terms and conditions.  All information in this document is true and correct to the best of my','','');
		$this->leftText(0.5,$y++,'knowledge.','','');
		
		$y+=2.5;
		$this->drawLine($y-0.8,'h',array(5,10));
		$this->drawLine($y-0.8,'h',array(25,10));
		$this->centerText(5,$y,'Signature Over Printed Name',10,'');
		
		$this->centerText(25,$y,'Date',10,'');
		$this->centerText(5,$y-1,$studentName,10,'');
		$this->centerText(25,$y-1,' ',10,'');

		$timestamp =  date('d M Y, h:i:s A',time());
		$this->leftText(1,$y+5,'Ref No.'.$inquiry['id'] .'  Date/Time Printed:'.$timestamp,'','');
	}
	
	
	
	
	
	
	
	
	
}
?>
	