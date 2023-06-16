<?php
require('vendors/fpdf17/formsheet.php');
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
	
	function hdr($data,$ass,$complete){
		//pr($complete); exit();
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
		$this->DrawImage(0,-0.8,2,0.7,__DIR__."/images/newlogo.png");
		$this->GRID['font_size']=14;
		$this->rightText(25.5,1.6,'ASSESSMENT FORM','','b');
		
		$this->GRID['font_size']=8;
		$this->rightText(0,$y+2,'S.Y. '. intval($ass['esp']).' - '.(intval($ass['esp'])+1),42,'');
        $this->leftText(.7,5,'CAT/Prefix: O/23','','b');
		$y=6;
		
		$this->leftText(.7,$y,'NAME OF STUDENT:','','b');
		$this->leftText(8,$y,$data['sno'].' / ','','');
		$this->leftText(12.2,$y,$data['print_name'],'','');
		
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
		$this->drawBox(0,5,38,2.5);

	}
	
	function data($data){
		$this->showLines = !true;
        $this->drawBox(0,6.2,38,10);
		//$metrics = $this->setUpMetrics($data);
		//$this->section($metrics);
		$this->GRID['font_size']=8;
		$y=7;
		$this->leftText(5,$y,'SCHOOL FEES',10,'b');
		$this->centerText(28,$y,'PAYMENT OPTIONS',4,'b');

		$end = $y+2;
		$this->fee_breakdown($data,$end);
		
		if(!isset($data['isRegForm'])):
			$this->payment_sched($data,$end);
			$this->foot_notes($data,$end);
		endif;
	
	}	
	
	function fee_breakdown($data,$end){
		//pr($data); exit();
		if(isset($data['isSecondSem']) &&$data['Assessment']['account_details']!='Irregular')
			return;
		
		$this->GRID['font_size']=7;

		//FEE BREAKDOWN
		
		$y=$end-1.2;
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
		$this->drawLine($y-0.6,'h',array(0,16));
		$this->leftText(0.2,$y,'Total','','b');
		$this->rightText(15,$y,number_format($total,2),'','b');
		$mod_bal = $data['Assessment']['module_balance'];
		if($mod_bal>0):
			$this->leftText(0.2,$y+1,'Modules & Ebooks','','b');
			$this->rightText(15,$y+1,number_format($mod_bal,2),'','b');
		endif;

	}

	function payment_sched($data,$end){
		$metrics =$this->setUpMetrics($data);
		$this->section($metrics);
		$this->GRID['font_size']=7;

		//PAYMENT SCHED
		$y=$end;
		$totaldue=0;
		$this->leftText(22.2,$y++,'PAYMENT SCHEDULE','','b');
		foreach($data['AssessmentPaysched'] as $d){
			$this->leftText(22.2,$y,date("M d, Y", strtotime($d['due_date'])),'','');
			if($d['due_amount']) $this->rightText(30,$y,number_format($d['due_amount'],2),3,'');
			else $this->rightText(30,$y,'--',3,'');
			$totaldue+=$d['due_amount'];
			$y++;
		}
	
		$this->drawLine($y-0.6,'h',array(22,11));
		$this->rightText(30,$y,number_format(round($totaldue),2),3,'b');
	}

	function foot_notes($data,$end){
		
	}
}
?>
	