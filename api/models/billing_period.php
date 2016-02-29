<?php
class BillingPeriod extends AppModel {
	var $name = 'BillingPeriod';
	var $useDbConfig = 'sfm';
	var $order = 'BillingPeriod.order';
	function getDueDates($sy,$period=null){
		$conditions = array();
		if($period)
			$conditions['BillingPeriod.id']=$period;
		$billingPeriodList =  $this->find('list',compact('conditions'));
		$billingPeriods =  $this->find('all',compact('conditions'));
		foreach($billingPeriods as $index=>$_BP){
			$bill_period= $_BP['BillingPeriod'];
			$mon_start	= $bill_period['bill_month_start'];
			$pay_freq	= $bill_period['payment_frequency'];
			$cutoff		= $bill_period['bill_cutoff_date'];
			$cycle		= $bill_period['bill_cycle_increment'];
			$due_dates	= array();
			$time 		= strtotime($sy.'-'.$mon_start.'-'.$cutoff);
			for($ctr=1;$ctr<=$pay_freq;$ctr++){
				$due_date = date('Y-m-d',$time);
				$time = strtotime($due_date.' '.$cycle);
				array_push($due_dates,$due_date);
			}
			$bill_period['due_dates'] = $due_dates;
			$billingPeriodList[$bill_period['id']] = $bill_period;
		}
		return $billingPeriodList;
	}
	function getBillMonths($due_dates){
		$bill_months = array();
		foreach($due_dates as $due_date){
			$time =  strtotime($due_date);
			$bill_month = date('M Y',$time);
			array_push($bill_months,$bill_month);
		}
		return $bill_months;
	}
}
