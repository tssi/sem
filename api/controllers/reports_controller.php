<?php
class ReportsController extends AppController{
	var $name = 'Reports';
	var $uses = array('Assessment','Student','Inquiry','Reservation','MasterConfig','Ledger','Household','Section');

	function student_registration_form($aid){
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
	        'conditions' => array(array('Assessment.id' => $aid)),
	        'contain'=>array(
	        	'Inquiry',
	        	'Student'=>array('Account'),
	        	'Section'=>array('id','name','YearLevel'),
	        	'AssessmentFee'=>array('id','due_amount','Fee'),
	        	'AssessmentPaysched',
	        	'AssessmentSubject'=>array('id','Subject')
	        ),
	        'limit' => 1,
    	);
    	$data = $this->paginate()[0];
    	
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
		$sectId = 9005;

		if(isset($_POST)){
			$sy = $_POST['Sy'];
			$sectId = $_POST['Section'];
		}
		$AIDs = $this->Assessment->getEnrolled($sy,$sectId);
		$DATA_BANK = array();

		// Use this code to test one student only
		// $AIDs = array($AIDs[0]); 

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