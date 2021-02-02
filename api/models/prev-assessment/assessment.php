<?php
class Assessment extends AppModel {
	var $name = 'Assessment';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'student_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'section_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tuition' => array(
			'className' => 'Tuition',
			'foreignKey' => 'tuition_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Scheme' => array(
			'className' => 'Scheme',
			'foreignKey' => 'scheme_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'AssessmentAdjustment' => array(
			'className' => 'AssessmentAdjustment',
			'foreignKey' => 'assessment_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'AssessmentFee' => array(
			'className' => 'AssessmentFee',
			'foreignKey' => 'assessment_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'AssessmentSchedule' => array(
			'className' => 'AssessmentSchedule',
			'foreignKey' => 'assessment_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	function prepareData($data){	
		$data['Assessment']['student_id'] = $data['Assessment']['student'];
		$data['Assessment']['gross_amount'] = $data['Assessment']['totals']['gross'];
		$data['Assessment']['charge_amount'] = $data['Assessment']['totals']['charges'];
		$data['Assessment']['discount_amount'] = $data['Assessment']['totals']['discounts'];
		//Schedule
		$data['AssessmentSchedule'] = array();
		foreach($data['Assessment']['schedules'] as $sched){
			$sched['assessment_id'] =null;
			$sched['due_amount'] = $sched['amount'];
			$sched['paid_amount'] = 0;
			unset($sched['amount']);
			array_push(	$data['AssessmentSchedule'],$sched);
		}
		//Adjustments
		$data['AssessmentAdjustment'] = array();
		$adjusments = array();
		foreach($data['Assessment']['adjustments'] as $adjust){
			$adjust['assessment_id'] =  null;
			$adjust['item_code'] =  $adjust['item']['code'];
			$adjust['flag'] =  $adjust['item']['flag'];
			unset($adjust['item']);
			if(!isset($adjusments[$adjust['item_code']])){
				$adjusments[$adjust['item_code']] = 0;
			}
			$amount = $adjust['flag']=='+'?$adjust['amount']:-$adjust['amount'];
			$adjusments[$adjust['item_code']]+=$amount;
			array_push(	$data['AssessmentAdjustment'],$adjust);
		}
		//Fees
		$data['AssessmentFee']=array();
		$this->Tuition->FeeBreakdown->recursive = -1;
		$this->Tuition->FeeBreakdown->order = 'FeeBreakdown.order';
		$conditions = array('FeeBreakdown.tuition_id'=>$data['Assessment']['tuition_id']);
		$fees = $this->Tuition->FeeBreakdown->find('all',array(compact('conditions','order')));
		foreach($fees as $fee){
			$fee = $fee['FeeBreakdown'];
			unset($fee['id']);
			unset($fee['tuition_id']);
			$fee['assessment_id'] = null;
			$fee['due_amount'] = $fee['amount'];
			if(isset($adjusments[$fee['fee_id']])){
				$fee['adjust_amount'] = $adjusments[$fee['fee_id']];
			}
			$fee['paid_amount']=0;
			array_push($data['AssessmentFee'],$fee);
		}
		$data = array(
			'Assessment'=>$data['Assessment'],
			'AssessmentFee'=>$data['AssessmentFee'],
			'AssessmentSchedule'=>$data['AssessmentSchedule'],
			'AssessmentAdjustment'=>$data['AssessmentAdjustment'],
		);
		return $data;
	}
	
	function afterFind($results){
		if(isset($results[0]['Assessment'])){
			foreach($results as $index=>$result){
				$initial_amount = $result['AssessmentSchedule'][0]['due_amount'];
				$results[$index]['Assessment']['initial_amount'] = $initial_amount;
				$results[$index]['Assessment']['webhooks'] = $this->testWebhook('ASSMNT',$results[$index]);
			}
		}
		return $results;
	}
	protected function testWebhook($channel,$data){
		$Webhook = &ClassRegistry::init('Webhooks.Webhook');
		$conditions = array('EventSource.channel_id'=>$channel);
		$events = array_values($Webhook->EventSource->find('list',compact('conditions')));
		$webhooks = $Webhook->findByEventSource($events);
		return $webhooks['Webhook'];
	}

}
