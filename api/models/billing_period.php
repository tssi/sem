<?php
class BillingPeriod extends AppModel {
	var $name = 'BillingPeriod';
	var $order = 'BillingPeriod.order';
	function getDueDates($sy){
		$billingPeriodList =  $this->find('list');
		$billingPeriods =  $this->find('all');
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
}
