<?php
class ReportsController extends AppController{
	var $name = 'Reports';
	var $uses = array('Assessment','Student','Inquiry','Reservation','MasterConfig','Ledger','Household','Section','Schedule');

	function student_registration_form($aid=null){
		$AID = $aid;
		if(isset($_POST['AssessmentId']))
			$AID = $_POST['AssessmentId'];
		$this->Assessment->recursive=2;
		$this->Assessment->Section->unbindModel(
        	array('hasMany' => array('Student'))
    	);

    	
    	// NOTE:PERFROMANCE IMRPOVEMENT
    	// Use paginate to take advantage of caching 
    	// Use contain to get relevant data only
    	$this->paginate = array(
	        'conditions' => array(array('Assessment.id' => $AID)),
	        'contain'=>array(
	        	'Inquiry',
	        	'Student'=>array('Account'),
	        	'Section'=>array('id','name','program_id','YearLevel'),
	        	'AssessmentFee'=>array('id','due_amount','Fee'),
	        	'AssessmentPaysched',
	        	'AssessmentSubject'=>array('id','schedule_id','created','Subject','Section','ScheduleDetail')
	        ),
	        'limit' => 1,
    	);
    	//$this->Assessment->AssessmentSubject->deleteAll(array('assessment_id'=>$aid));

    	$data = $this->paginate()[0];
    	$assId = $data['Assessment']['id'];
    	$sectId = $data['Assessment']['section_id'];
    	$sectId = $data['Assessment']['section_id'];
    	$esp = $data['Assessment']['esp'];
    	$asmModified =  (int)date('Ymd',strtotime($data['Assessment']['modified']));

    	// Check if AssessmentSubject has been created
    	if(isset($data['AssessmentSubject'][0]))
    		$asbCreate =  (int)date('Ymd',strtotime($data['AssessmentSubject'][0]['created']));
    	else
    		$asbCreate = 0;

    	// Check if ASB is updated compared to ASM modified	
    	$isAssSubjUpdated = $asbCreate > $asmModified;

    	//Check if section is block or mixed
    	$isBlock =  $data['Section']['program_id']!='MIXED';

    	// Re-initialize Assesssment Subject for block section
    	if($isBlock && !$isAssSubjUpdated):
			$sCond =  array(array('Schedule.section_id'=>$sectId, 'Schedule.esp'=>$esp));
	    	$sched = $this->Schedule->find('first',array('conditions'=>$sCond));
	    	$schedId =  $sched['Schedule']['id'];
	    	$assSubjs = array();
	    	$subjNrol = array();

	    	// Loop into schedule details and map to subjects
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
		
		// Map Assessment Fees to display totals by fee type
		$fees =  $data['AssessmentFee'];
		$feeTotals = array();
		foreach($fees as $f){
			$type =  $f['Fee']['type'];
			$name =  $f['Fee']['name'];
			
			if(!isset($feeTotals[$type])){
				// Use description based on type
				switch($type){
					case 'TF': $label = 'Tuition Fee'; break;
					case 'LAB': $label = 'Laboratory Fee'; break;
					case 'MSC': $label = 'Misc. Fee'; break;
					
					// If fee is different from the 3 main types use the fee name
					default: $label = $name; break; 
				}
				$feeTotals[$type] = array('label'=>$label,'total'=>0);
			}
			$feeTotals[$type]['total']+=$f['due_amount'];
		}
		// Create new array collection using the feeSummary and swap the AssessmentFee data
		//pr($spons); exit();
		$feeSummary = array();
		foreach($data['Assessment'] as $key=>$val){
			//pr($val);
			switch($key){
				case 'discount_amount':
					if($val<0){
						$feeTotals['SUBS']= array('label'=>'Subsidy','total'=>$val);
					}
					break;
				/* case 'payment_total':
					if($val>0){
						if($val===1000)
							$feeTotals['ADVP']= array('label'=>'Advance Payment','total'=>-$val);
						else{
							$feeTotals['RSRV']= array('label'=>'Reservation','total'=>-1000);
							if(($val-1000)>0)
								$feeTotals['ADVP']= array('label'=>'Advance Payment','total'=>-($val-1000));
						}
					}
					break; */
			}
		}
		if(isset($res[0])){
			foreach($res as $r){
				switch($r['Reservation']['field_type']){
					case 'RSRVE':
						$feeTotals['RSRV']= array('label'=>'Reservation','total'=>-$r['Reservation']['amount']);
					break;
					case 'ADVP':
						$feeTotals['ADVP']= array('label'=>'Reservation','total'=>-$r['Reservation']['amount']);
					break;
				}
			}
		}
		if(isset($spons[0])){
			$feeTotals['SPONS']= array('label'=>'Sponsorship','total'=>-$spons[0]['Ledger']['amount']);
		}
		//pr($feeTotals); exit();
		foreach($feeTotals as $i=>$f){
			$feeSum = array('Fee'=>array('name'=>$f['label']),'due_amount'=>$f['total']);
			array_push($feeSummary,$feeSum);
		}
		
		$config = $this->MasterConfig->findBySysKey('ASSMT_MEMO');
		$config = $config['MasterConfig']['sys_value'];
		
		$data['AssessmentFee'] =  $feeSummary;
		$data['Important'] = $config;
		//pr($data); exit();
		$this->set(compact('data'));
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

		if(isset($_POST['Sy'])){
			$sy = $_POST['Sy'];
			$sectId = $_POST['Section'];
			$type =  $_POST['Type'];
			$student =  $_POST['Student'];
		}
		if($type=='single'){
			$refNo = $this->Ledger->getRefNo($student,'TUIXN',$sy);
			$AIDs = array($refNo);
		}else{
			$AIDs = $this->Assessment->getEnrolled($sy,$sectId);
		}
		
		$DATA_BANK = array();

		// Use this code to test one student only
		//$AIDs = array($AIDs[0]); 

		// Run contents of AIDs for batch loading
		foreach($AIDs as $aid):
			$this->student_registration_form($aid);
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
				//Init household if not exist
				if(!$this->Household->hasHousehold($ACC)){
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
	
}