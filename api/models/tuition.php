<?php
class Tuition extends AppModel {
	var $name = 'Tuition';
	var $recursive = 2;
	var $useDbConfig = 'sfm';
	var $virtualFields = array(
						'code_sy'=>"RIGHT(Tuition.sy,2)",
						'display_sy'=>"CONCAT(Tuition.sy,' - ',Tuition.sy+1)",
						);
	var $actsAs = array('Containable');
	var $contain = array('FeeBreakdown',
						'YearLevel.id',
						'YearLevel.name',
						'Program.id',
						'Program.name',
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
		),
		'Program' => array(
			'className' => 'Program',
			'foreignKey' => 'program_id',
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
	var $hasMany = array(
			'FeeBreakdown'=>array(
				'order'=>'FeeBreakdown.order',
			),
			'PaymentScheme'=>array(
				'order'=>'PaymentScheme.order'
				)
			);
	function afterFind($results){
		if(isset($results[0]['Tuition'])){
			//pr($results);
			$BillingPeriod  = &ClassRegistry::init('BillingPeriod');
			foreach($results as $index=>$result){
				if(isset($result['Program']['name']))
					$results[$index]['Tuition']['program']=$result['Program']['name'];
				if(isset($result['YearLevel']['name']))
					$results[$index]['Tuition']['year_level']=$result['YearLevel']['name'];
				if(isset($result['Tuition']['sy']))
					$billingPeriods = $BillingPeriod->find('list');
				//Fee Breakdown
				if(isset($result['FeeBreakdown'])){
					$fees = array();
					foreach($result['FeeBreakdown'] as $breakdown){
						$fee = array(
							'id'=>$breakdown['fee_id'],
							'fee_breakdown_id'=>$breakdown['id'],
							'name'=>$breakdown['Fee']['name'],
							'amount'=>(double)$breakdown['amount'],
						);
						array_push($fees,$fee);
					}
					$results[$index]['Tuition']['fees']=$fees;
				}
				//Discounts
				if(isset($result['Discount'])){
					$discounts = array();
					foreach($result['Discount'] as $discount){
						$fees_applicable = $discount['fees_applicable'];
						if($fees_applicable!='all')
							$fees_applicable =  explode(',',$fees_applicable);
						else
							$fees_applicable =  array('all');
						$discount = array(
							'id'=>$discount['id'],
							'tuition_discount_id'=>$discount['TuitionDiscount']['id'],
							'name'=>$discount['name'],
							'type'=>$discount['type'],
							'amount'=>(double)$discount['amount'],
							'display_amount'=>$discount['display_amount'],
							'fees_applicable'=>$fees_applicable,
						);
						array_push($discounts,$discount);
					}
					$results[$index]['Tuition']['discounts']=$discounts;
				}
				//Payment Scheme
				if(isset($result['PaymentScheme'])){
					$schemes = array();
					foreach($result['PaymentScheme'] as $scheme){
						$schedules=array();
						//Payment Scheme Schedule
						foreach($scheme['PaymentSchemeSchedule'] as $schedule){
							$bill_period = $billingPeriods[$schedule['billing_period_id']];
							$due_dates = explode(',',$schedule['due_dates']);
							$bill_months = $BillingPeriod->getBillMonths($due_dates);
							$schedule = array(
								'id'=>$schedule['id'],
								'payment_scheme_id'=>$schedule['payment_scheme_id'],
								'billing_period_id'=>$schedule['billing_period_id'],
								'billing_period'=>$bill_period,
								'due_dates'=>$due_dates,
								'bill_months'=>$bill_months,
								'amount'=>(double)$schedule['amount'],
							);
							array_push($schedules,$schedule);
						}
						$schedules =  $this->PaymentScheme->PaymentSchemeSchedule->sortSchedule($schedules);
						$scheme =array(
							'id'=>$scheme['Scheme']['id'],
							'name'=>$scheme['Scheme']['name'],
							'payment_frequency'=>(int)$scheme['Scheme']['payment_frequency'],
							'total_amount'=>(double)$scheme['total_amount'],
							'variance_amount'=>(double)$scheme['variance_amount'],
							'schedule'=>$schedules,
						);
						array_push($schemes,$scheme);
					}
					$results[$index]['Tuition']['schemes']=$schemes;
				}
			}
		}
		return $results;
	}
}
