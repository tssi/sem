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

        //$this->drawLine(32,'h',array(-2,42));
		if(isset($start))
            $y=$start;
		$this->DrawImage(0,$y-1.8,2,0.7,__DIR__."/images/newlogo.png");
		$this->GRID['font_size']=14;
		$this->leftText(25.5,$y+.6,'ASSESSMENT FORM','','b');
		
		$SNO =  trim($data['sno']);
		$this->GRID['font_size']=8;
		$this->rightText(0,$y+2,'S.Y. '. intval($ass['esp']).' - '.(intval($ass['esp'])+1),42,'');
		$y+=4;
		$this->leftText(.7,$y,'Name of Student:','','');
		$this->leftText(7,$y,$data['last_name'].', '.$data['first_name'].' '.$data['middle_name'],'','b');
		$y++;
		$yearLevel = 'Incoming '.$complete['Section']['YearLevel']['description'];
		if($complete['Section']['department_id']=='SH')
			$yearLevel .= ' '.$complete['Section']['Program']['name'];
		$this->leftText(.7,$y,'Grade Level: ' ,'','');
		$this->leftText(7,$y,$yearLevel,'','b');
		$this->GRID['font_size']=6;
		$yearLevel = 'Current '.$data['YearLevel']['description'];
		$yearLevel .= ' '.$data['Section']['name'];
		$this->leftText(7,$y+1,$yearLevel,'','');
		$this->GRID['font_size']=8;


		// Barcode Display
		$bx = 5.3; // X Position
		if($start==1)
			$by = 0.85; // Y Position
		else 
			$by=5.1;
		$code=$SNO; // Data to be encode can be alphanumeric and dash ex. 2022-1234
		$color = '000'; // RGB color
		$w = 0.015; // width
		$h = 0.2; // Height
		$angle = 0; // Angle rotation
		$type = 'code128'; // Format code128 make shorter barcode
		Barcode::fpdf($this, $color, $bx, $by, $angle, $type, $code,$w,$h);  
		$this->rightText(32,5.5+$start,trim($data['sno']),5,'');
		// TODO: Display barcode top and bottom portion underneath assessment form label

		
	}
	
	function newstudent($data,$ass,$sec,$start){
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
		//$this->drawLine(32,'h',array(-2,42));
		$y=1;

		//pr($start); exit();
		if(isset($start))
            $y=$start;
		$this->DrawImage(0,$y-1.8,2,0.7,__DIR__."/images/newlogo.png");
		$this->GRID['font_size']=14;
		$this->leftText(25.5,$y+.6,'ASSESSMENT FORM','','b');
		
		$this->GRID['font_size']=8;
		$this->rightText(0,$y+2,'S.Y. '. intval($ass['esp']).' - '.(intval($ass['esp'])+1),42,'');
		$y+=4;
        
		//$SNO = trim($data['sno']);
		$this->leftText(.7,$y,'Name of Student:','','');
		$this->leftText(7,$y,$data['last_name'].', '.$data['first_name'].' '.$data['middle_name'],'','b');
		$y++;
		$yearLevel = 'Incoming '.$sec['YearLevel']['description'];
		
		if($sec['department_id']=='SH')
			$yearLevel .= ' '.$sec['Program']['name'];
		$this->leftText(.7,$y,'Grade Level: ' ,'','');
		$this->leftText(7,$y,$yearLevel,'','b');
		$this->GRID['font_size']=8;
		// Barcode Display
		$bx = 5.3; // X Position
		if($start==1)
			$by = 0.85; // Y Position
		else 
			$by=5.1;
		$code=$data['id']; // Data to be encode can be alphanumeric and dash ex. 2022-1234
		$color = '000'; // RGB color
		$w = 0.015; // width
		$h = 0.2; // Height
		$angle = 0; // Angle rotation
		$type = 'code128'; // Format code128 make shorter barcode
		Barcode::fpdf($this, $color, $bx, $by, $angle, $type, $code,$w,$h);
		$this->rightText(33,5.5+$start,$data['id'],5,'');

	}
	
	function data($data,$start){
        
		$this->showLines = !true;
        $this->drawBox(0,$start-1,38,13.5);
		$this->GRID['font_size']=8;
		$y=$start;
		$this->leftText(5,$y,'SCHOOL FEES',10,'');
		$this->centerText(28,$y,'PAYMENT OPTIONS',4,'');
		$this->GRID['font_size']=7;
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
		$this->GRID['font_size']=7;

		//PAYMENT SCHED
		$y=$end;
		$totaldue=0;
        $this->leftText(30,$y,'OPTION A',10,'b');
        $this->leftText(34,$y,'OPTION B',10,'b');
        
        $y++;
        $this->GRID['font_size']=7;
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
        $y=$y+2;
        $this->leftText(1,$y,'Payment Option:','','b');
        $this->drawBox(9,$y-.7,.8,.8);
        $this->leftText(10,$y,'Option A (Installment)','','');
        $this->drawBox(19,$y-.7,.8,.8);
        $this->leftText(20,$y,'Option B (Full Payment)','','');
        $note = 'Note: Enrollment starts on June 15, 2023. To serve you better, we request that you indicate the date and time you plan to go to';
        $note1 = 'LSEI for the enrollment this S.Y. 2023 - 2024. Date: _______________ Time: _______________';
        $this->GRID['font_size']=7;
        
        $this->leftText(1,$y+1,$note,'i','');
        $this->leftText(1,$y+2,$note1,'i','');
        $this->GRID['font_size']=8;
        $y=$y+4;
        $this->leftText(27,$y,'____________________________','i','');
        $this->GRID['font_size']=6;
        $this->leftText(28,$y+1,'SIGNATURE OVER PRINTED NAME','','');
        $this->GRID['font_size']=8;
        $this->leftText(30,$y+2,'Parent/Guardian','','b');
	}

	function foot_notes($data,$end){
		
	}
}
?>
	