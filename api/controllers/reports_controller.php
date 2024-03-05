<?php
class ReportsController extends AppController{
	var $name = 'Reports';
	var $uses = array('Assessment','Student','Inquiry','Reservation','MasterConfig','TransactionType','Subject',
						'Ledger','Household','Section','Schedule','Tuition','Curriculum','CurriculumSection','AdvisorySection','Teacher');
	
	function student_pre_assess_form(){
		$AID = $_POST['AssessmentId'];
		if(is_array(json_decode($AID))) {
			$data_bank = array();
			foreach(json_decode($AID) as $id){
				$this->student_registration_form($id);
				$data = $this->viewVars['data'];
				array_push($data_bank,$data);
			}
			$this->set(compact('data_bank'));
		}else
			$this->student_registration_form();
	}


	function student_registration_form($aid=null,$curri_esp=null,$sem=null){
		$AID = $aid;
		
		if(isset($_POST['AssessmentId'])&&!is_array(json_decode($_POST['AssessmentId'])))
			$AID = $_POST['AssessmentId'];
		$this->Assessment->recursive=2;
		$this->Assessment->Section->unbindModel(
        	array('hasMany' => array('Student'))
    	);
		
    	//pr($AID); exit();
		if(is_array(json_decode($AID))) {}
		

		// NOTE:PERFROMANCE IMRPOVEMENT
		// Use paginate to take advantage of caching 
		// Use contain to get relevant data only
		$this->paginate = array(
			'conditions' => array(array('Assessment.id' => $AID)),
			'contain'=>array(
				'Inquiry',
				'Student'=>array('Account','Section','YearLevel'),
				'Section'=>array('id','name','program_id','department_id','YearLevel','Program'),
				'AssessmentFee'=>array('id','due_amount','Fee'),
				'AssessmentPaysched',
				'AssessmentSubject'=>array('id','schedule_id','created','Subject','Section','ScheduleDetail')
			),
			'limit' => 1,
		);
		
		//pr($this->paginate()); exit();
		$data = $this->paginate()[0];
		$assId = $data['Assessment']['id'];
		$sectId = $data['Assessment']['section_id'];
		$esp = $data['Assessment']['esp'];
		$sy = floor($esp);
		$stud_program = $data['Section']['program_id'];
		$level = $data['Section']['year_level_id'];
		$asmModified =  (int)date('Ymd',strtotime($data['Assessment']['modified']));


		$isSecondSem=false;

		if(preg_match('/\d{4}\.45/',$esp)){
			$sem=45;
			$isSecondSem = true;
		}

		if($data['Assessment']['account_details']==''&&$sem==45){
			//pr('dumaan'); exit();
			$isSecondSem=true;
			$subjects = array();
			$curId = $this->CurriculumSection->findBySectionId($sectId,$curri_esp);
			$curId = $curId['CurriculumSection']['curriculum_id'];
			//pr($curId); exit();
			$curriculum = $this->Curriculum->find('all',array('conditions'=>array('Curriculum.id'=>array($curId))));
			//pr($curriculum); exit();
			foreach($curriculum[0]['CurriculumDetail'] as $c){
				if($level==$c['year_level_id']){
					$subItem = array(
						'subject_id'=>$c['Subject']['id'],
						'Subject'=>$c['Subject'],
						'Section'=>array('name'=>$data['Section']['name']),'created'=>''
					);
					array_push($subjects,$subItem);
				}
			}
			$isSH =  $level=='GY' || $level=='GZ';
			if(!$isSH)
				$curri_esp =  floor($curri_esp);
			$schedule = $this->Schedule->getSched($sectId,$curri_esp);
			foreach($subjects as $i=>$sub){
				$scheds = array();
				//pr($sub);exit();
				foreach($schedule[0]['ScheduleDetail'] as $sched){
					if($sub['subject_id']==$sched['subject_id']){
						array_push($scheds,$sched);
					}
				}
				///pr($scheds);exit();
				$sub['ScheduleDetail'] = $scheds;
				$subjects[$i]=$sub;
			}
			$data['AssessmentSubject']=$subjects;
		}
		// Check if AssessmentSubject has been created
		if(isset($data['AssessmentSubject'][0]))
			$asbCreate =  (int)date('Ymd',strtotime($data['AssessmentSubject'][0]['created']));
		else
			$asbCreate = 0;

		$sy = floor($esp);
		
		$yl = $data['Section']['year_level_id'];
		$tuition = $this->Tuition->getTuiDetail($sy,$yl);
		$isIrreg = $tuition['assessment_total']!=$data['Assessment']['assessment_total'];
		// Check if ASB is updated compared to ASM modified	
		$isAssSubjUpdated = 0;
		if($asbCreate > $asmModified)
			$isAssSubjUpdated = 1;

		//Check if section is block or mixed
		$isBlock =  $data['Section']['program_id']!='MIXED';
		/* pr($asbCreate); 
		pr($asmModified); 
		exit(); */
		// Re-initialize Assesssment Subject for regular student
		if(!$isIrreg && $isAssSubjUpdated==1):
			$sCond =  array(array('Schedule.section_id'=>$sectId, 'Schedule.esp'=>$esp));
			if(!in_array($yl,array('GY','GZ')))
				$sCond =  array(array('Schedule.section_id'=>$sectId,'Schedule.esp'=>floor($esp)));
			$sched = $this->Schedule->find('first',array('conditions'=>$sCond));
			$schedId =  $sched['Schedule']['id'];
			$assSubjs = array();
			$subjNrol = array();

			// Loop into schedule details and map to subjects
			//pr($sCond); exit();
			foreach($sched['ScheduleDetail'] as $dtl):
				$subjId = $dtl['subject_id'];
				// Skip if subject already added
				if(in_array($subjId, $subjNrol)) continue;
				// Record enrolled subjects
				array_push($subjNrol,$subjId);

				// Build Assessed Subjects data
				$assSubj = array('assessment_id'=>$assId,
						'subject_id'=>$subjId,
						'section_id'=>$sectId,
						'schedule_id'=>$schedId);
				array_push($assSubjs,$assSubj);

			endforeach;

			// Clear existing assessed subjects
			$asjCond = array('AssessmentSubject.assessment_id'=>$assId);
			$this->Assessment->AssessmentSubject->recursive=0;
			$this->Assessment->AssessmentSubject->deleteAll($asjCond,false);
			$this->Assessment->AssessmentSubject->saveAll($assSubjs);
			// Request fresh data
			
			$this->Assessment->usePaginationCache = false;
			$data = $this->paginate()[0];
		endif;
		
		$id = $data['Assessment']['student_id'];
		$resESP = $esp = round($data['Assessment']['esp'],0);
		$esp = substr($esp.'', -2);

		// Request records from Reservation
		$res = $this->Reservation->getRecords($id,$resESP);
		// Request records from Ledger with SPO prefix
		$spons = $this->Ledger->getRecords($id,$esp,'SPO');
		$othrs = $this->Ledger->getRecords($id,$esp,'OTH');
		
		// Map Assessment Fees to display totals by fee type
		$fees =  $data['AssessmentFee'];
		$feeTotals = array();
		foreach($fees as $f){
			if($f['fee_id']=='OTH'):
				$f['Fee']['type']='2OTH';
				$f['Fee']['name']='Others';
			endif;
			$ogType = $type =  $f['Fee']['type'];
			$name =  $f['Fee']['name'];
			//pr($f);
			if($type!="2OTH"):
				$type="1".$type;
				if($type=="1TF")
					$type = "0TF";
				if($type=='1DSC')
					$type = '4DSC';
			endif;

			// NOTE: Resolve discount breakdown for SY 2024
			if($sy>=2024 && $ogType=='DSC'):
				// Adjust type code to prevent from combining amounts and display in correct order
				$type =$f['id'].'DSC'.$f['fee_id'];
			endif;

			if(!isset($feeTotals[$type])){
				// Use description based on type
				switch($ogType){
					case 'TF': $label = 'Tuition and other fees'; break;
					case 'LAB': $label = 'Laboratory Fee'; break;
					case 'MSC': $label = $isSecondSem?'Registration':'Misc. Fee'; break;
					case 'TUT': $label = 'Tutorial Fee'; break;
					case 'DSC': $label = $name; break;
					
					// If fee is different from the 3 main types use the fee name
					default: $label = $name; break; 
				}
				
				$feeTotals[$type] = array('label'=>$label,'total'=>0,'order'=>1);
			}
			$feeTotals[$type]['total']+=$f['due_amount'];
		}

		// Create new array collection using the feeSummary and swap the AssessmentFee data
		
		$feeSummary = array();
		foreach($data['Assessment'] as $key=>$val){
			//pr($val);
			switch($key){
				case 'discount_amount':
					if($val<0){
						$feeTotals['3SUBS']= array('label'=>'Subsidy','total'=>$val);
					}
					break;
			}
		}
		if(isset($res[0])){
			foreach($res as $r){
				switch($r['Reservation']['field_type']){
					case 'RSRVE':
						$feeTotals['3RSRV']= array('label'=>'Reservation','total'=>-$r['Reservation']['amount']);
					break;
					case 'ADVTP':
						$feeTotals['3ADVTP']= array('label'=>'Advance Payment','total'=>-$r['Reservation']['amount']);
					break;
				}
			}
		}
		if(isset($spons[0])){
			$feeTotals['3SPONS']= array('label'=>'Sponsorship','total'=>-$spons[0]['Ledger']['amount']);
		}
		if(isset($othrs[0])){
			$othr =  $othrs[0]['Ledger'];
			$oth_lbl =  sprintf("%s - %s",$othr['details'],$othr['notes'] );
			$feeTotals['2OTH']= array('label'=>$oth_lbl,'total'=>$othr['amount']);
		}

		ksort($feeTotals);
		foreach($feeTotals as $i=>$f){
			$feeSum = array('Fee'=>array('name'=>$f['label']),'due_amount'=>$f['total']);
			array_push($feeSummary,$feeSum);
		}
		
		$config = $this->MasterConfig->findBySysKey('ASSMT_MEMO');
		$config = $config['MasterConfig']['sys_value'];
		if($data['Assessment']['account_details']=='Adjust'){
			$feeSummary=array(
				array('name'=>'First Sem Tuition','due_amount'=>$data['Assessment']['first']),
				array('name'=>'Second Sem Tuition','due_amount'=>$data['Assessment']['second']),
				array('name'=>'Misc','due_amount'=>$data['Assessment']['misc']),
				array('name'=>'Reg fee','due_amount'=>$data['AssessmentFee'][1]['due_amount']),
				array('name'=>'Subsidy','due_amount'=>$data['Assessment']['discount_amount']),
			);
		}
			
		$data['AssessmentFee'] =  $feeSummary;
		$data['Important'] = $config;
		if($isSecondSem){
			if(count($data['AssessmentSubject'])==0)
				$data['AssessmentSubject'] = $subjects;
			$data['isSecondSem'] = true;
		}
		
		//pr($sectId); 
		//pr($sy); 
		$subjectScheds = $this->Schedule->getSched($sectId,$sy);
		//pr($subjectScheds); exit;
		if(!isset($subjectScheds[0])){
			//echo $sectId;
			$subjectScheds = $this->Schedule->getSched($sectId,$sy+.25);
			//pr($subjectScheds); exit;
		}
		$studSubjects = array();
		if(count($subjectScheds)):
			foreach($subjectScheds[0]['ScheduleDetail'] as $i=>$sched){
				if(!in_array($sched['subject_id'],$studSubjects)) array_push($studSubjects,$sched['subject_id']);
				
			}
		endif;
		$studSchedules = array();
		foreach($studSubjects as $i=>$sub){
			//echo $sub;
			$studSchedules[$sub] = array();
			foreach($subjectScheds[0]['ScheduleDetail'] as $detail){
				
				if($sub==$detail['subject_id']){
					$subject = $this->Subject->getSubjectById($sub);
					if(isset($subject[0]))
						$detail['Subject'] = $subject[0]['Subject'];
					else $dtail['Subject']['name'] = $sub;
					array_push($studSchedules[$sub],$detail);
					//$studSubjects[$i]['SchduleDetail'] = $detail;
					//array_push($studSchedules,$detail);
				}
			}
		}
		//pr($subjectScheds);
		if($data['Section']['department_id']=='SH') $sy = $sy+.10;
		
		$advisory = $this->AdvisorySection->getAdvisorySection($sectId,$sy);
		$data['studSchedules'] = $studSchedules;
		//pr($data['studSchedules']);
		if($data['Assessment']['subsidy_status']=='IRREG'){
			$irregSched = array();
			foreach($data['AssessmentSubject'] as $sub){
				$irregSched[$sub['subject_id']] = array();
				foreach($sub['ScheduleDetail'] as $details){
					$details['Subject'] = $sub['Subject'];
					array_push($irregSched[$sub['subject_id']],$details);
				}
			}
			$data['studSchedules'] = $irregSched;
		} 
		//pr($data['AssessmentSubject']); 
		//pr($data['AssessmentSubject']);
		//pr($data['studSchedules']);
		//exit;
		if($advisory):
			$data['Teacher'] = $advisory[0]['Teacher']['first_name'].' '.$advisory[0]['Teacher']['last_name'];
		endif;
		//pr($advisory);
		//exit;
		$this->set(compact('data','sy'));
		
			
	}
	
	function student_inquiry_information_sheet(){
		$data =  array();
		$IID =  $_POST['InquiryID'];
		$data = $this->Inquiry->findById($IID);
		$this->set(compact('data'));
	}
	
	function reg_form($aid=null){
		ini_set('max_execution_time', '0');
		
		$sy = 2021;
		$sectId = 7004;
		$type = 'batch';
		$student = null;
		if(isset($_REQUEST['Sy'])){
			$esp = $_REQUEST['Sy'].'.'.$_REQUEST['Sem'];
			$sem = $_REQUEST['Sem'];
			$sy = $_REQUEST['Sy'];
			$sectId = $_REQUEST['Section'];
			
			$student =  $_REQUEST['Student'];
			$type =  $student?"single":"batch";
		}

		if($type=='single'){
			$refNo = $this->Assessment->getAssessment($student,$esp);
			if(!isset($refNo))
				$refNo = $this->Ledger->getRefNo($student,'TUIXN',$sy);
			$AIDs = array($refNo);
			
		}else{
			$AIDs = $this->Assessment->getEnrolled($sy.'.25',$sectId);
		}
		
		$DATA_BANK = array();

		// Use this code to test one student only
		//$AIDs = array($AIDs[0]); 

		// Run contents of AIDs for batch loading
		foreach($AIDs as $aid):
			$this->student_registration_form($aid,$esp,$sem);
			$data  = $this->viewVars['data'];
			$ASM   = $data['Assessment'];
			$SID   = $ASM['student_id'];
			
			// Check $SID starts with LSN
			if(preg_match("/^LSN/i", $SID)){
				//Look up for related account_id in ledger by Assessment.id & TUIXN
				$ACC = $this->Ledger->getAccountId($ASM['id'], 'TUIXN');
				if(!$ACC):

					$sCond =  array(
								array('Student.last_name'=>$data['Inquiry']['last_name']),
								array('Student.first_name'=>$data['Inquiry']['first_name']),
								array('Student.middle_name'=>$data['Inquiry']['middle_name']),
					);
					$Stud = $this->Student->find('first',array('conditions'=>$sCond));
					// Legender Entries
					$SACC = $Stud['Account'];
					$ACID =  $SACC['id'];
					$ESP = $ASM['esp'];
					$TDATE =  date('Y-m-d',strtotime($SACC['created']));
					$TTIME =  date('H:i:s',strtotime($SACC['created']));
					$REFNO =  $ASM['id'];

					$ENTRIES = array();

					// Tuition and Other Fees
					$ENTRY =	array(
								'details'=>'Tuition and Other Fees',
								'account_id'=>$ACID,'type'=>'+',
								'transaction_type_id'=>'TUIXN','esp'=>$ESP,
								'transact_date'=>$TDATE,'transac_time'=>$TTIME,
								'amount'=>$TDATE,'ref_no'=>$REFNO,
								'notes'=>'ERRCO',
							);
					
					array_push($ENTRIES,$ENTRY);

					if($SACC['discount_amount']<0):
						// Discount 
						$ENTRY['details']= 'Discount';
						$ENTRY['type']= '-';
						$ENTRY['transaction_type_id']= $SACC['subsidy_status'];
						$ENTRY['amount']= abs($SACC['discount_amount']);					

						array_push($ENTRIES,$ENTRY);
					endif;				
					//TODO: Missing IP Transaction, Reservation and Sponor
					$this->Ledger->saveAll($ENTRIES);

					// Set ACC to ACID (Account ID)
					$ACC  =  $ACID;
				endif;

				$INQ =  $data['Inquiry'];
				$hasHH = $this->Household->hasHousehold($ACC);
				
				if($hasHH){
					$HHO  = $this->Household->getInfo($SID);
					if(isset($HHO['members'])):
						$hasHH = count($HHO['members'])>0;
					endif;
				}
				//Init household if not exist
				if(!$hasHH){
					// Init home address & contact
					$home = array();
					
					$home['street'] 	= $INQ['c_address'];
					$home['barangay'] 	= $INQ['barangay'];
					$home['city'] 		= $INQ['city'];
					$home['province'] 	= $INQ['province'];
					$home['mobile'] 	= $INQ['mobile'];
					
					$grd ['first_name']	= $INQ['g_first_name'];
					$grd ['middle_name']= $INQ['g_middle_name'];
					$grd ['last_name']	= $INQ['g_last_name'];
					$grd ['rel']		= $INQ['g_rel'];
					$home['guardian']	= $grd;
					$home['student'] 	= $ACC;

					$HOM = $this->Household->initHome($home);
					
				}
				$SID = $ACC;
				$this->Student->recursive =0;
				$STU = $this->Student->findById($SID);
				$data['Student']= $STU['Student'];
				$data['Student']['Account'] =  $STU['Account'];
				
			}

			$HHO   = $this->Household->getInfo($SID);
			
			$HHO['father_name'] = "N/A";
			$HHO['mother_name'] = "N/A";
			
			foreach($HHO['members'] as $member){
				switch(strtoupper($member['rel'])){
					case 'FATHER': 
						$HHO['father_name']  =  $member['name'];
					break;
					case 'MOTHER': 
						$HHO['mother_name']  =  $member['name'];
					break;
				}
				$HHO['username']	 =  $member['guid'];
				$HHO['password']	 =  $member['pass'];
			}
			$data['Student']['Household'] =  $HHO;

			array_push($DATA_BANK,$data);

		endforeach;

		$this->set(compact('DATA_BANK'));
		
		//pr($data);exit;
		//$contents = file_get_contents(APP."json/regform.json");
		//$data =  json_decode($contents,true);
		//$this->set(compact('data'));


	}
	function print_reserve(){
		//pr(json_decode($_POST['reserves'])); exit();
		//$data = $this->Reservation->find('all',array('conditions'=>array('Reservation.esp'=>2021,'Reservation.field_type'=>'RSRVE')));
		$data = json_decode($_POST['reserves'],true);
		$data['date'] = date("l jS \of F Y H:i:s");
		//pr($data); exit();
		$this->set(compact('data'));
	}

	function enrollment(){
		//$contents = file_get_contents(APP."json/enrollment.json");
		//pr($_POST); exit();
		$contents = $_POST['enrollments'];
		$json  =  json_decode($contents,true);
		//pr($json); exit();
		// TODO: Get data from database instead of test json data
		$data =  $json;
		$this->set(compact('data'));
	}
	
	function print_list(){
		//$contents = file_get_contents(APP."json/enrollment.json");
		//pr($_POST); exit();
		$contents = $_POST['list'];
		$json  =  json_decode($contents,true);
		//pr($json); exit();
		// TODO: Get data from database instead of test json data
		$data =  $json;
		$this->set(compact('data'));
	}
	function view($form){
		switch($form):
			case 'f1c':
				$this->form_f1c();
			break;
			case '201':
				$this->form_201();
			break;
			case 'cf1':
				$this->form_cf1();
			break;
			case 'gf1':
				$this->form_gf1();
			break;
		endswitch;
	}

	function form_f1c(){
		$this->loadInqInfo();
		$this->render('form_f1c');
	}
	

	function form_201(){
		$this->loadInqInfo();
		$this->render('form_201');

	}
	function form_cf1(){

	}
	function form_gf1(){

	}

	protected function loadInqInfo(){
		$student = null;
		if(isset($_REQUEST['InquiryID'])):
			$id =  $_REQUEST['InquiryID'];
			$student =  $this->Inquiry->findById($id);
			$inquiry = $student['Inquiry'];
			$inquiry['full_name'] =str_replace(', ', '_', $inquiry['full_name']);
			$timestamp = date('ymdHi',time());
			$fileName = sprintf('F1C-%s__%s_%s.pdf',$inquiry['id'],$inquiry['full_name'],$timestamp);
			$this->set(compact('student','fileName'));
		endif;
	}
}