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
	
	function info(){
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
		$this->leftText(0,$y++,'Name','','b');
		
		$this->leftText(1,$y,'Last Name','','i');
		$this->leftText(11,$y,'First Name','','i');
		$this->leftText(21,$y,'Middle Name','','i');
		$this->leftText(31,$y,'Extension','','i');
		$y++;
		$this->leftText(1,$y,'Dela Cruz','','');
		$this->leftText(11,$y,'Juan','','');
		$this->leftText(21,$y,'Santos','','');
		$this->leftText(31,$y,'Maganda','','');
		
		$y+=2;
		$this->leftText(0,$y++,'BASIC INFORMATION','','b');
		
		$this->leftText(1,$y,'Gender','','i');
		$this->leftText(6,$y,'Civil Status','','i');
		$this->leftText(11,$y,'Date of Birth','','i');
		$this->leftText(19,$y,'Place of Birth','','i');
		$this->leftText(33,$y,'Citizenship','','i');
		$y++;
		$this->leftText(1,$y,'Male','','');
		$this->leftText(6,$y,'Single','','');
		$this->leftText(11,$y,'03 September 2002','','');
		$this->leftText(19,$y,utf8_decode('Biñan City, Laguna'),'','');
		$this->leftText(33,$y,'Filipino','','');
		
		$y+=1.5;
		$this->leftText(1,$y,'Mobile No.','','i');
		$this->leftText(11,$y,'Landline No.','','i');
		$y++;
		$this->leftText(1,$y,'0999-123-9876','','');
		$this->leftText(11,$y,'(03) 405-3338','','');
		
		$y+=1.5;
		$this->leftText(1,$y,'Address','','i');
		$y++;
		$this->leftText(1,$y,'123 A. Bonifacio St., Brgy Canlalay, Binan Laguna','','');
		
		$y+=2;
		$this->leftText(0,$y++,'ACADEMICS','','b');
		$this->leftText(1,$y,'Entry Level: ','','i');
		$this->leftText(11,$y,'Last School Attended:','','i');
		
		$this->leftText(5,$y,'Grade 7','','');
		$this->leftText(18,$y,'Iskul Bukol University','','');
		
		$y=22;
		$this->leftText(0,$y++,'GUARDIAN INFORMATION','','b');
		$y=23;
		$this->leftText(1,$y++,'Name of Guardian:','','i');
		$this->rightText(6.1,$y++,'Address:','','i');
		$this->rightText(6.1,$y++,'Contact No:','','i');
		$this->rightText(6.1,$y++,'Occupation:','','i');
		$this->rightText(6.1,$y++,'Relation:','','i');
		
		$y=23;
		$this->leftText(6.5,$y++,'Mamang Surbetero','','');
		$this->leftText(6.5,$y++,'123 A. Bonifacion St., Brgy Canlalay, Binan Laguna','','');
		$this->leftText(6.5,$y++,'091712345','','');
		$this->leftText(6.5,$y++,'Self-Employed','','');
		$this->leftText(6.5,$y++,'Parent','','');
			

		$dvdr ='-------------------------------------------------------------------';
		$this->leftText(0,$y,$dvdr.$dvdr.$dvdr,'','');

		$y+=1.5;
		$this->leftText(0,$y,'Please check if all the information above is accurate. Thank you for your interest in Lake Shore Educational Institution.  ','','i');
		$y+=2;
		$this->centerText(0,$y,'TERMS AND CONDITIONS',41,'b');
		
		$y+=1.5;
		$this->leftText(1,$y++,'1.  Your Reference Number is LSNxxxxxxx.','','');
		$this->leftText(1,$y++,'2.  Reservation for enrollment for School Year 2021 - 2022 is from March 5, 2021 to June 15, 2021.','','');
		$this->leftText(1,$y++,'3.  Reservation fee is non-refundable.','','');
		$this->leftText(1,$y++,'4.  Reservation fee is automatically deducted from the school fees for School Year 2021 - 2022.','','');
		$this->leftText(1,$y++,'5.  Lake Shore Educational Institution will process the application of the student\'s Education Service Contracting (ESC) grant upon payment of the','','');
		$this->leftText(1,$y++,'    reservation fee.','','');
		$this->leftText(1,$y++,'6.  ESC subsidy is subject to Private Education Assistance Committee (PEAC) approval.','','');
		$this->leftText(1,$y++,'7.  Payment of reservation fee does not guarantee approval of ESC subsidy.','','');
		$this->leftText(1,$y++,'8.  Lake Shore Educational Institution is obliged to discuss reason(s) for the disapproval of ESC grant by PEAC. ','','');
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
		$this->centerText(5,$y-1,'Juan Dela Cruz',10,'');
		$this->centerText(25,$y-1,'mm-dd-yyyy',10,'');
		                                 
	}
	
	
	
	
	
	
	
	
	
}
?>
	