<?php
class Tuition extends AppModel {
	var $name = 'Tuition';
	var $recursive = 2;
	var $actsAs = array('Containable');
	var $contain = array('FeeBreakdown',
						'FeeBreakdown.Fee.name',
						'Discount',
						'PaymentScheme',
						'PaymentScheme.Scheme',
						'PaymentScheme.PaymentSchemeSchedule',
						);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'YearLevel' => array(
			'className' => 'YearLevel',
			'foreignKey' => 'year_level_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $hasAndBelongsToMany = array(
        'Discount' =>
            array(
                'className'              => 'Discount',
                'joinTable'              => 'tuition_discounts',
                'foreignKey'             => 'tuition_id',
                'associationForeignKey'  => 'discount_id',
                'unique'                 => true,
                'conditions'             => '',
                'fields'                 => '',
                'order'                  => '',
                'limit'                  => '',
                'offset'                 => '',
                'finderQuery'            => '',
                'deleteQuery'            => '',
                'insertQuery'            => ''
            )
    );
	var $hasMany = array('FeeBreakdown','PaymentScheme');
	function afterFind($results){
		if(isset($results[0]['Tuition'])){
			//pr($results);
			$BillingPeriod  = &ClassRegistry::init('BillingPeriod');
			$billingPeriods = $BillingPeriod->find('list');
			foreach($results as $index=>$result){
				//Fee Breakdown
				$fees = array();
				foreach($result['FeeBreakdown'] as $breakdown){
					$fee = array(
						'id'=>$breakdown['fee_id'],
						'name'=>$breakdown['Fee']['name'],
						'amount'=>(double)$breakdown['amount'],
					);
					array_push($fees,$fee);
				}
				$results[$index]['Tuition']['fees']=$fees;
				//Discounts
				$discounts = array();
				foreach($result['Discount'] as $discount){
					$fees_applicable = $discount['fees_applicable'];
					if($fees_applicable!='all')
						$fees_applicable =  explode(',',$fees_applicable);
					$discount = array(
						'id'=>$discount['id'],
						'name'=>$discount['name'],
						'type'=>$discount['type'],
						'amount'=>(double)$discount['amount'],
						'fees_applicable'=>$fees_applicable,
					);
					array_push($discounts,$discount);
				}
				$results[$index]['Tuition']['discounts']=$discounts;
				//Payment Scheme
				$schemes = array();
				foreach($result['PaymentScheme'] as $scheme){
					$schedules=array();
					//Payment Scheme Schedule
					foreach($scheme['PaymentSchemeSchedule'] as $schedule){
						$due_dates = explode(',',$schedule['due_dates']);
						$schedule = array(
							'id'=>$schedule['id'],
							'billing_period_id'=>$schedule['billing_period_id'],
							'billing_period'=>$billingPeriods[$schedule['billing_period_id']],
							'due_dates'=>$due_dates,
							'amount'=>(double)$schedule['amount'],
						);
						array_push($schedules,$schedule);
					}
					$scheme =array(
						'id'=>$scheme['Scheme']['id'],
						'name'=>$scheme['Scheme']['name'],
						'payment_frequency'=>(int)$scheme['Scheme']['payment_frequency'],
						'amount'=>(double)$scheme['amount'],
						'interest_charge'=>(double)$scheme['interest_charge'],
						'schedule'=>$schedules,
					);
					array_push($schemes,$scheme);
				}
				$results[$index]['Tuition']['schemes']=$schemes;
			}
		}
		return $results;
	}
}
