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
		$AID = $ass['id'];

		$SNO =  trim($data['sno']);
		$this->GRID['font_size']=8;
		$type =$start>1?"REGISTRAR'S COPY":"STUDENT'S COPY";
		$tX =  $start>1? 43.5:42.75;
		$this->rightText(0,$y+2,$type,$tX,'');
		$this->rightText(0,$y+3,'S.Y. '. intval($ass['esp']).' - '.(intval($ass['esp'])+1),38,'');

		$this->GRID['font_size']=8.5;

		$y+=4.5;
		$this->leftText(.7,$y,'Name of Student:','','');
		$name =  ($data['last_name'].', '.$data['first_name'].' '.$data['middle_name']);
		$name =  ucwords(strtolower($name));
		$name =  utf8_decode($name);
		$this->leftText(7.5,$y,$name,'','b');
		$y++;
		$yearLevel = 'Incoming '.$complete['Section']['YearLevel']['description'];
		if($complete['Section']['department_id']=='SH')
			$yearLevel .= ' '.$complete['Section']['Program']['name'];
		$this->leftText(.7,$y,'Grade Level: ' ,'','');
		$this->leftText(7.5,$y,$yearLevel,'','b');
		$y++;
		$this->leftText(.7,$y,'Student No: ' ,'','');
		$this->leftText(7.5,$y,$SNO,'','b');
		$this->GRID['font_size']=6;
		//$yearLevel = 'Current '.$data['YearLevel']['description'];
		//$yearLevel .= ' '.$data['Section']['name'];
		//$this->leftText(7,$y+1,$yearLevel,'','');
		$this->GRID['font_size']=8;


		// Barcode Display
		$bx = 5.3; // X Position
		if($start==1)
			$by = 0.85; // Y Position
		else 
			$by=5.1;
		$by+=0.12;
		$code=$AID; // Replace with Assessment ID
		$color = '000'; // RGB color
		$w = 0.015; // width
		$h = 0.25; // Height
		$angle = 0; // Angle rotation
		$type = 'code128'; // Format code128 make shorter barcode
		Barcode::fpdf($this, $color, $bx, $by, $angle, $type, $code,$w,$h);  
		$this->leftText(26,6.75+$start,'Ref No.',12,'');
		$this->rightText(26,6.75+$start,$AID,12,'');

		
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
		$type =$start>1?"REGISTRAR'S COPY":"STUDENT'S COPY";
		$tX =  $start>1? 43.5:42.75;
		$this->rightText(0,$y+2,$type,$tX,'');
		$this->rightText(0,$y+3,'S.Y. '. intval($ass['esp']).' - '.(intval($ass['esp'])+1),38,'');
		$y+=4.5;
        
		$AID = $ass['id'];
		$IID = $data['id'];
		$this->GRID['font_size']=8.5;
		$this->leftText(.7,$y,'Name of Student:','','');
		$name =  ($data['last_name'].', '.$data['first_name'].' '.$data['middle_name']);
		$name =  ucwords(strtolower($name));
		$name =  utf8_decode($name);
		$this->leftText(7.5,$y,$name,'','b');
		$y++;
		$yearLevel = 'Incoming '.$sec['YearLevel']['description'];
		
		if($sec['department_id']=='SH')
			$yearLevel .= ' '.$sec['Program']['name'];
		$this->leftText(.7,$y,'Grade Level: ' ,'','');
		$this->leftText(7.5,$y,$yearLevel,'','b');
		$y++;
		$this->leftText(.7,$y,'Inquiry No: ' ,'','');
		$this->leftText(7.5,$y,$IID,'','b');

		$this->GRID['font_size']=8;
		// Barcode Display
		$bx = 5.3; // X Position
		if($start==1)
			$by = 0.85; // Y Position
		else 
			$by=5.1;
		$by+=0.12;
		$code=$AID; // Data to be encode can be alphanumeric and dash ex. 2022-1234
		$color = '000'; // RGB color
		$w = 0.015; // width
		$h = 0.25; // Height
		$angle = 0; // Angle rotation
		$type = 'code128'; // Format code128 make shorter barcode
		Barcode::fpdf($this, $color, $bx, $by, $angle, $type, $code,$w,$h);
		$this->leftText(26,6.75+$start,'Ref No.',12,'');
		$this->rightText(26,6.75+$start,$AID,12,'');

	}
	
	function data($data,$start){
		$this->showLines = !true;
		$start = $start +1;
        $this->drawBox(0.75,$start-1,37.25,13.5);
		$this->GRID['font_size']=8;
		$y=$start;
		$this->leftText(7,$y,'SCHOOL FEES',10,'');
		$this->centerText(29,$y,'PAYMENT SCHEDULE',4,'');
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
		
		$y=$end+0.5;
		$total=0;
		foreach($data['AssessmentFee'] as $d){
			if($data['Assessment']['account_details']=='Adjust')			
				$this->leftText(1.5,$y,$d['name'],'','');
			else
				$this->leftText(1.5,$y,$d['Fee']['name'],'','');
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
		$this->leftText(1.5,$y,'Balance Due','','b');
		$this->rightText(15,$y,number_format($total,2),'','b');
		$mod_bal = $data['Assessment']['module_balance'];
		if($mod_bal>0):
			$this->leftText(0.2,$y+1,'Modules & Ebooks','','b');
			$this->rightText(15,$y+1,number_format($mod_bal,2),'','b');
		endif;

		$this->GRID['font_size']=7;
		
		if($data['Section']['department_id']=='SH'&&$data['Assessment']['esp']<2024):
			$y+=6;
			$this->wrapText(0.2,$y,'Notice: Modules and eBook waived for Grade 11 & 12 effective on 17 July 2023.',16);
		endif;

	}

	function payment_sched($data,$end){
		$this->GRID['font_size']=7;

		//PAYMENT SCHED
		$y=$end;
		$totaldue=0;
        //$this->leftText(30,$y,'OPTION A',10,'b');
       // $this->leftText(34,$y,'OPTION B',10,'b');
        
        $y+=0.5;
        $this->GRID['font_size']=7;
		foreach($data['AssessmentPaysched'] as $i=>$d){
            if($i!=0)
			    $this->leftText(25.2,$y,date("F Y", strtotime($d['due_date'])),'','');
            else
                $this->leftText(25.2,$y,'Upon Enrollment','','');

                if($d['due_amount']) $this->rightText(33,$y,number_format($d['due_amount'],2),3,'');
			else $this->rightText(30,$y,'--',3,'');
			$totaldue+=$d['due_amount'];
			$y++;
		}
		$year = floor($data['Assessment']['esp']);
		$schoolYear =  sprintf("%s - %s",$year, $year+1);
        //$this->leftText(34,$y-10,number_format($totaldue,2),10,'');
		//$this->drawLine($y-0.6,'h',array(22,11));

		// Total Due
		$this->rightText(33,$y,number_format(round($totaldue),2),3,'b');
		
		//$this->rightText(34,$y,number_format(round($totaldue),2),3,'b');
        $y=$y+2;
        /*
        $this->leftText(1,$y,'Payment Option:','','b');
        $this->drawBox(9,$y-.7,.8,.8);
        $this->leftText(10,$y,'Option A (Installment)','','');
        $this->drawBox(19,$y-.7,.8,.8);
        $this->leftText(20,$y,'Option B (Full Payment)','','');
        */
        $note = 'Note: Enrollment starts on June 15, '.$year.'. To serve you better, we request that you indicate the date and time you plan to go to';
        $note1 = 'LSEI for the enrollment this S.Y. '.$schoolYear.'. Date: _______________ Time: _______________';
        $this->GRID['font_size']=7;
        
        $this->leftText(1,$y+1,$note,'i','');
        $this->leftText(1,$y+2,$note1,'i','');


        
         $timestamp =  sprintf("Date Generated: %s",date('d M Y h:i a',time()));
        $this->leftText(0.5,$y+5.5,$timestamp,'','');
        $this->GRID['font_size']=6;
        $version =  sprintf("%s",APP_VERSION);
        $this->leftText(0.5,$y+6.5,$version,'','');
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
	