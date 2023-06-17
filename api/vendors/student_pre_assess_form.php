<?php
require('vendors/fpdf17/formsheet.php');
require(__DIR__.'/fpdf17/barcode/php-barcode.php');
class StudentPreAssessForm extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 6.5;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
	protected static $curr_page = 1;
	protected static $page_count;
	protected static $ctr = 1.8;
	protected static $grand_total = 0;
	
	function StudentPreAssessForm(){
		$this->showLines = !true;
		$this->FPDF(StudentPreAssessForm::$_orient, StudentPreAssessForm::$_unit,array(StudentPreAssessForm::$_width,StudentPreAssessForm::$_height));
		$this->createSheet();
	}
	
	function hdr($data,$ass,$complete,$start){
		$this->showLines = !true;
        
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 0.25,
			'width'=> 6,
			'height'=> 0.5,
			'cols'=> 38,
			'rows'=> 4,	
		);
		$this->section($metrics);
        $y=1;
        $this->drawLine(32,'h',array(-2,42));
		if(isset($start))
            $y=$start;
		//pr($start); exit();
		$this->DrawImage(0,$y-1.8,2,0.7,__DIR__."/images/newlogo.png");
		$this->GRID['font_size']=14;
		$this->leftText(25.5,$y+.6,'ASSESSMENT FORM','','b');
		
		$this->GRID['font_size']=8;
		$this->rightText(0,$y+2,'S.Y. '. intval($ass['esp']).' - '.(intval($ass['esp'])+1),42,'');
        $this->leftText(.7,$y+4,'CAT/Prefix: O/23','','b');
		$SNO = trim($data['sno']);
		$this->leftText(.7,$y+5,'NAME OF STUDENT:','','b');
		$this->leftText(8,$y+5,$SNO.' / ','','');
		$this->leftText(12.2,$y+5,$data['print_name'],'','');


		// Barcode Display
		$bx = 5.3; // X Position
		$by = 0.85; // Y Position
		$code=$SNO; // Data to be encode can be alphanumeric and dash ex. 2022-1234
		$color = '000'; // RGB color
		$w = 0.015; // width
		$h = 0.2; // Height
		$angle = 0; // Angle rotation
		$type = 'code128'; // Format code128 make shorter barcode
		Barcode::fpdf($this, $color, $bx, $by, $angle, $type, $code,$w,$h);  
		// TODO: Display barcode top and bottom portion underneath assessment form label

		
	}
	
	function newstudent($data,$ass,$sec){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 0.25,
			'width'=> 6,
			'height'=> 0.5,
			'cols'=> 38,
			'rows'=> 4,	
		);
		$this->section($metrics);
		$y=1;
		$this->DrawImage(5,-0.8,0.7,0.7,__DIR__."/images/logo.png");
		$this->GRID['font_size']=10;
		$this->centerText(0,$y++,'LAKE SHORE EDUCATIONAL INSTITUTION',38,'b');
		$this->GRID['font_size']=7;
		$this->centerText(0,$y++,'BONIFACIO ST., CANLALAY, BINAN, LAGUNA',38,'');
		$this->centerText(0,$y++,'STUDENT REGISTRATION FORM',38,'b');
		$this->centerText(0,$y++,'ONE YEAR DURATION SCHOOL YEAR ' . intval($ass['esp']).' - '.(intval($ass['esp'])+1),38,'');
		$y=6;
		$this->rightText(5,$y,'STUDENT ID:','','b');
		$this->leftText(15,$y++,'LEVEL/COURSE:','','b');
		$this->rightText(5,$y,'NAME:','','b');
		$this->leftText(25,$y,'DATE/TIME:','','b');
		$y=6;
		$this->leftText(5.5,$y,'','','');
		$this->leftText(20.5,$y++,$sec['YearLevel']['description'].' - '.$sec['name'],'','');
		$this->leftText(5.5,$y,$data['last_name'].','.$data['first_name'].' '.$data['middle_name'],'','');
		$this->leftText(29,$y,date("M d,Y h:i:s A"),'','');
		

	}
	
	function data($data,$start){
        
		$this->showLines = !true;
        $this->drawBox(0,$start-.8,38,13);
		$this->GRID['font_size']=8;
		$y=$start;
		$this->leftText(5,$y,'SCHOOL FEES',10,'b');
		$this->centerText(28,$y,'PAYMENT OPTIONS',4,'b');

		$end = $y+1;
		$this->fee_breakdown($data,$end);
		
		if(!isset($data['isRegForm'])):
			$this->payment_sched($data,$end);
			$this->foot_notes($data,$end);
		endif;
	
	}	
	
	function fee_breakdown($data,$end){
		if(isset($data['isSecondSem']) &&$data['Assessment']['account_details']!='Irregular')
			return;
		
		$this->GRID['font_size']=8;

		//FEE BREAKDOWN
		
		$y=$end;
		$total=0;
		foreach($data['AssessmentFee'] as $d){
			if($data['Assessment']['account_details']=='Adjust')			
				$this->leftText(0.2,$y,$d['name'],'','');
			else
				$this->leftText(0.2,$y,$d['Fee']['name'],'','');
			if($d['due_amount']>=0)
				$this->rightText(15,$y,number_format($d['due_amount'],2),'','');
			else{
				$amt = abs($d['due_amount']);
				$this->rightText(15,$y,'('.number_format($amt,2).')','','');
			
			}
			$total+=$d['due_amount'];
			$y++;
		}
		//$this->drawLine($y-0.6,'h',array(0,16));
		$this->leftText(0.2,$y,'Total','','b');
		$this->rightText(15,$y,number_format($total,2),'','b');
		$mod_bal = $data['Assessment']['module_balance'];
		if($mod_bal>0):
			$this->leftText(0.2,$y+1,'Modules & Ebooks','','b');
			$this->rightText(15,$y+1,number_format($mod_bal,2),'','b');
		endif;

	}

	function payment_sched($data,$end){
		$this->GRID['font_size']=8;

		//PAYMENT SCHED
		$y=$end;
		$totaldue=0;
        $this->leftText(30,$y,'OPTION A',10,'b');
        $this->leftText(34,$y,'OPTION B',10,'b');
        
        $y++;
		foreach($data['AssessmentPaysched'] as $i=>$d){
            if($i!=0)
			    $this->leftText(22.2,$y,date("F Y", strtotime($d['due_date'])),'','');
            else
                $this->leftText(22.2,$y,'Upon Enrollment','','');

                if($d['due_amount']) $this->rightText(30,$y,number_format($d['due_amount'],2),3,'');
			else $this->rightText(30,$y,'--',3,'');
			$totaldue+=$d['due_amount'];
			$y++;
		}
        $this->leftText(34,$y-10,number_format($totaldue,2),10,'');
		//$this->drawLine($y-0.6,'h',array(22,11));
		$this->rightText(30,$y,number_format(round($totaldue),2),3,'b');
		$this->rightText(34,$y,number_format(round($totaldue),2),3,'b');
        $y=$y+1.5;
        $this->leftText(1,$y,'Payment Option:','','b');
        $this->drawBox(9,$y-.7,.8,.8);
        $this->leftText(10,$y,'Option A (Installment)','','');
        $this->drawBox(19,$y-.7,.8,.8);
        $this->leftText(20,$y,'Option B (Fullpayment)','','');
        $note = 'Note: Early enrollment will start this June 15, 2023. To serve you better, we request that you indicate the date and time you plan to go to';
        $note1 = 'LSEI for the enrollment this SY 2023 - 2024. Date: _______________ Time: _______________';
        $this->GRID['font_size']=7;
        
        $this->leftText(1,$y+1,$note,'i','');
        $this->leftText(1,$y+2,$note1,'i','');
        $this->GRID['font_size']=8;
        $y=$y+4;
        $this->leftText(27,$y,'____________________________','i','');
        $this->leftText(28,$y+1,'Signiture Over Printed Name','i','');
        $this->leftText(30,$y+2,'Parent/Guardian','i','');
	}

	function foot_notes($data,$end){
		
	}
}
?>
	