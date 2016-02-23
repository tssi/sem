<?php
class PaymentSchemeSchedule extends AppModel {
	var $name = 'PaymentSchemeSchedule';
	var $belongsTo = array('PaymentScheme','BillingPeriod');
	function beforeSave($options){
		$data = $this->data['PaymentSchemeSchedule'];
		if(isset($data[0])){
			foreach($data as $index=>$datum){
				$billing_period_id = $datum['billing_period_id'];
				$tuition_id = $datum['tuition_id'];
				$scheme_id = $datum['scheme_id'];
				$pay_schem_info = $this->PaymentScheme->getPaySchemeInfo($tuition_id,$scheme_id);
				$datum['payment_scheme_id'] = $pay_schem_info['pay_scheme_id'];
				if(!isset($datum['id'])){
					$this->deleteAll(array(
						'payment_scheme_id'=>$pay_schem_info['pay_scheme_id'],
						'billing_period_id'=>$billing_period_id
						));
				}
				$due_dates = $this->BillingPeriod->getDueDates($pay_schem_info['sy'],$billing_period_id);
				$datum['due_dates'] = implode(',',$due_dates[$billing_period_id]['due_dates']);
				$data[$index] = $datum;
			}
		}else{
			$billing_period_id = $data['billing_period_id'];
			$tuition_id = $data['tuition_id'];
			$scheme_id = $data['scheme_id'];
			$pay_schem_info = $this->PaymentScheme->getPaySchemeInfo($tuition_id,$scheme_id);
			if(!isset($data['id'])){
				$this->deleteAll(array(
						'payment_scheme_id'=>$pay_schem_info['pay_scheme_id'],
						'billing_period_id'=>$billing_period_id
						));
			}
			$data['payment_scheme_id'] = $pay_schem_info['pay_scheme_id'];
			$due_dates = $this->BillingPeriod->getDueDates($pay_schem_info['sy'],$billing_period_id);
			$data['due_dates'] = implode(',',$due_dates[$billing_period_id]['due_dates']);
		}
		
		$this->data['PaymentSchemeSchedule']=$data;
		return true;
	}
	function sortSchedule($schedule){
		$__schedule =  array();
		$periods = $this->BillingPeriod->find('list');
		foreach($periods as $key=>$value){
			foreach($schedule as $sched){
				if($sched['billing_period_id']==$key){
					array_push($__schedule,$sched);
					break;
				}
			}
		}
		return $__schedule;
	}
}