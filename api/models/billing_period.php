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
			$due_dates			= array();
			$bill_months		= array();
			$time 		= strtotime($sy.'-'.$mon_start.'-'.$cutoff);
			for($ctr=1;$ctr<=$pay_freq;$ctr++){
				$due_date = date('Y-m-d',$time);
				$bill_month = date('M Y',$time);
				$time = strtotime($due_date.' '.$cycle);
				array_push($due_dates,$due_date);
				array_push($bill_months,$bill_month);
			}
			$bill_period['due_dates'] = $due_dates;
			$bill_period['bill_months'] = $bill_months;
			$billingPeriodList[$bill_period['id']] = $bill_period;
		}
		return $billingPeriodList;
	}
}
