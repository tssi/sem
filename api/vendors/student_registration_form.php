<?php
require('vendors/fpdf17/formsheet.php');
class StudentRegistrationForm extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 6.5;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
	protected static $curr_page = 1;
	protected static $page_count;
	protected static $ctr = 1.8;
	protected static $grand_total = 0;
	
	function StudentRegistrationForm(){
		$this->showLines = !true;
		$this->FPDF(StudentRegistrationForm::$_orient, StudentRegistrationForm::$_unit,array(StudentRegistrationForm::$_width,StudentRegistrationForm::$_height));
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
		$this->DrawImage(5,-0.8,0.7,0.7,__DIR__."/images/logo.png");
		$this->GRID['font_size']=10;
		$this->centerText(0,$y++,'LAKE SHORE EDUCATIONAL INSTITUTION',38,'b');
		$this->GRID['font_size']=7;
		$this->centerText(0,$y++,'BONIFACIO ST., CANLALAY, BI'.utf8_decode('Ñ').'AN, LAGUNA',38,'');
		$this->centerText(0,$y++,'Assessment Form (AF 21-001)',38,'b');
		$this->centerText(0,$y++,'ONE YEAR DURATION SCHOOL YEAR '. intval($ass['esp']).' - '.(intval($ass['esp'])+1),38,'');
		$y=6;
		$this->rightText(5,$y,'STUDENT ID:','','b');
		$this->leftText(15,$y++,'LEVEL/COURSE:','','b');
		$this->leftText(25.5,$y-1,'SECTION:','','b');
		$this->rightText(5,$y,'NAME:','','b');
		$this->leftText(25,$y,'DATE/TIME:','','b');
		$y=6;
		//pr($data);exit;
		$this->leftText(5.5,$y,$data['sno'],'','');
		$this->leftText(20.5,$y++,$complete['Section']['YearLevel']['name'].'-'.$complete['Section']['Program']['name'],'','');
		$this->leftText(5.5,$y,$data['print_name'],'','');
		$this->leftText(29,$y,date("M d,Y h:i:s A"),'','');
		$this->leftText(29,$y-1,$complete['Section']['name'],'','');
		$this->drawBox(0,5,38,2.5);
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
		//pr($sec);exit;
		//pr($data); exit();
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
		//pr($data); exit();
		$this->showLines = !true;
		$metrics = $this->setUpMetrics($data);

		$this->section($metrics);
		$this->GRID['font_size']=7;
		$y=0;
		$this->leftText(0,$y,'SUBJECTS',10,'b');
		//$this->centerText(15,$y,'UNITS',2,'b');
		//$this->leftText(15,$y,'SECTION','','b');
		$this->centerText(11,$y,'DAY',2,'b');
		$this->centerText(15,$y,'PERIOD',2,'b');
		$this->centerText(20,$y,'TIME',4,'b');
		$this->centerText(27,$y,'TIME2',4,'b');
		//$this->leftText(28.2,$y++,'TEACHER','','b');
		//pr($data);exit;

		//ASSESSMENT
		//$totalunits=0;
		$y++;
		//pr($data['AssessmentSubject']);exit;
		foreach($data['AssessmentSubject'] as $d){
			//$this->leftText(0.2,$y,$d['subject_id'],'','');

			if(strlen($d['Subject']['name'])>=45){
				$d['Subject']['name'] = substr($d['Subject']['name'],0,30) . '...';
			}
			$this->leftText(0,$y,$d['Subject']['name'],'','');
			//$this->centerText(15,$y,'--',2,'');
			if(isset($d['Section']['name']))
				//$this->leftText(15,$y,$d['Section']['name'],'','');
			$x_time = 20;
			$x_day = 14;
			$lastItem = end($d['ScheduleDetail']);
			$length = count($d['ScheduleDetail']);
			//pr($d['ScheduleDetail']); exit();
			foreach($d['ScheduleDetail'] as $sched):
				$day =  $sched['day'];
				$startT =  date('h:i A',strtotime($sched['start_time']));
				$endT =  date('h:i A',strtotime($sched['end_time']));
				$time = sprintf("%s-%s",$startT,$endT);
				$grading = $sched['grading'];
				//pr($sched); exit();
				if($sched['id']!=$lastItem['id']||$length==1){
					$this->centerText(11,$y,$day,2,'');
					$this->centerText($x_day,$y,$grading,4,'');
				}
				$this->centerText($x_time,$y,$time,4,'');
				
				$x_time+=7;
				$x_day+=7;
			endforeach;
			$y++;
			if(!count($d['ScheduleDetail'])) $y++;


			//$this->leftText(29.2,$y,'--','','');
			//$totalunits+=$d['Subject']['units'];
		
		}
		$this->drawLine($y-0.6,'h');
		$this->leftText(0.2,$y,'Total No. of Subject: '.count($data['AssessmentSubject']),'','b');
		//$this->centerText(15,$y,number_format($totalunits,2),2,'b');
		$end = $y+2;
		$this->fee_breakdown($data,$end);
		
		if(!isset($data['isRegForm'])):
			$this->payment_sched($data,$end);
			$this->foot_notes($data,$end);
		endif;
	
	}	
	function setUpMetrics($data){
		$metrics = array(
			'base_x'=> 0.5,
			'base_y'=> 1.4,
			'width'=> 5.5,
			'height'=> 0.6,
			'cols'=> 33,
			'rows'=> 4,	
		);
		if(isset($data['offsetY']))
			$metrics['base_y'] +=  $data['offsetY'];

		if(isset($data['offsetX']))
			$metrics['base_x'] +=  $data['offsetX'];
		return $metrics;

	}
	function fee_breakdown($data,$end){
		//pr($data); exit();
		if(isset($data['isSecondSem']))
			return;
		
		$metrics =$this->setUpMetrics($data);

		$this->section($metrics);
		$this->GRID['font_size']=7;

		//FEE BREAKDOWN
		
		$y=$end-1.2;
		$total=0;
		$this->leftText(0.2,$y++,'FEE BREAKDOWN','','b');
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
		$this->leftText(0.2,$y+1,'Modules & Ebooks','','b');
		$this->rightText(15,$y+1,number_format($data['Assessment']['module_balance'],2),'','b');

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
		$this->rightText(30,$y,number_format($totaldue,2),3,'b');
	}

	function foot_notes($data,$end){
		$metrics =$this->setUpMetrics($data);

		$this->GRID['font_size']=7;


		$AID = $data['Assessment']['id'];
		$student = $data['Assessment']['student_id'];

		App::import('Vendor','phpqrcode/qrlib');
		App::import('Model','Record');
		
		$fileName = 'aid-'.$AID.'.png';
		
		$Record =  new Record();
		$fullPath = $Record->registerFile($fileName,$student,'img');
		QRcode::png($AID,$fullPath);

		$this->DrawImage(0,32,1.1,1.1,$fullPath);
		$this->leftText(0.75,32.5,"CODE: " .$AID,12,'b');
		$this->RotateText(0.5,38.5,'SCAN @ CASHIER',90);

		//NOTE
		$y=39;
		$this->wrapText(0,$y,'IMPORTANT: '.$data['Important'],25);
	}
}
?>
	