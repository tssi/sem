<?php
class ReportsController extends AppController{
	var $name = 'Reports';
	var $uses = array('Assessment','Student','Inquiry','Reservation','MasterConfig','Ledger');

	function student_registration_form($aid){
		$AID = $aid;
		if(isset($_POST['AssessmentId']))
			$AID = $_POST['AssessmentId'];
		$this->Assessment->recursive=2;
		$this->Assessment->Section->unbindModel(
        	array('hasMany' => array('Student'))
    	);
		$data = $this->Assessment->findById($AID);
		$id = $data['Assessment']['student_id'];
		$esp = round($data['Assessment']['esp'],0);
		$esp = substr($esp.'', -2);
		//pr($data); exit();
		$res = $this->Reservation->find('all',array('recursive'=>0,'conditions'=>array('account_id'=>$id)));
		$spons = $this->Ledger->find('all',array('recursive'=>0,'conditions'=>array('account_id'=>$id,'ref_no LIKE'=>'SPO'.$esp)));
		//pr($spons); exit();
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
	function reg_form($aid){
		$this->student_registration_form($aid);
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