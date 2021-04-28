<?php
class ReportsController extends AppController{
	var $name = 'Reports';
	var $uses = array('Assessment','Student','Inquiry','Reservation');

	function student_registration_form(){
	
		$this->Assessment->recursive=2;
		$data = $this->Assessment->findById($_POST['AssessmentId']);
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
		//pr($feeTotals); exit();
		$feeSummary = array();
		foreach($data['Assessment'] as $key=>$val){
			//pr($val);
			switch($key){
				case 'discount_amount':
					if($val<0){
						$feeTotals['SUBS']= array('label'=>'Less Subsidy','total'=>$val);
					}
					break;
				case 'payment_total':
					if($val>0){
						if($val===1000)
							$feeTotals['ADVP']= array('label'=>'Less Advance Payment','total'=>-$val);
						else{
							$feeTotals['RSRV']= array('label'=>'Less Reservation','total'=>-1000);
							$feeTotals['ADVP']= array('label'=>'Less Advance Payment','total'=>-($val-1000));
						}
					}
					break;
			}
			
		}
		//pr($feeTotals); exit();
		foreach($feeTotals as $i=>$f){
			$feeSum = array('Fee'=>array('name'=>$f['label']),'due_amount'=>$f['total']);
			array_push($feeSummary,$feeSum);
		}
		//pr($feeSummary); exit();
		$data['AssessmentFee'] =  $feeSummary;
		//pr($data['AssessmentFee']); exit();
		$this->set(compact('data'));
	}
	
	function student_inquiry_information_sheet(){
		$data =  array();
		$IID =  $_POST['InquiryID'];
		$data = $this->Inquiry->findById($IID);
		$this->set(compact('data'));
	}
	
	function print_reserve(){
		pr(json_decode($_POST['reserves'])); exit();
	}
	
}