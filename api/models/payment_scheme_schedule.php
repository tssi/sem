<?php
class PaymentSchemeSchedule extends AppModel {
	var $name = 'PaymentSchemeSchedule';
	var $belongsTo = array('PaymentScheme','BillingPeriod');
	function beforeSave($options){
		$data = $this->data['PaymentSchemeSchedule'];
		$billing_period_id = $data['billing_period_id'];
		$tuition_id = $data['tuition_id'];
		$scheme_id = $data['scheme_id'];
		$pay_schem_info = $this->PaymentScheme->getPaySchemeInfo($tuition_id,$scheme_id);
		$data['payment_scheme_id'] = $pay_schem_info['pay_scheme_id'];
		$due_dates = $this->BillingPeriod->getDueDates($pay_schem_info['sy'],$billing_period_id);
		$data['due_dates'] = implode(',',$due_dates[$billing_period_id]['due_dates']);
		$this->data['PaymentSchemeSchedule']=$data;
		return true;
	}
}