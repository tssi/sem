<?php
class AssessmentsController extends AppController {

	var $name = 'Assessments';
	var $uses = array('Assessment','AssessmentFee','AssessmentPaysched','AssessmentSubject','AccountSchedule','Account','Ledger');

	function index() {
		$this->Assessment->recursive = 0;
		$assessments = $this->paginate();
		foreach($assessments as $i=>$ass){
			//pr($ass); exit();
			$data = $ass['Assessment'];
			$paysched = array();
			foreach($ass['AssessmentPaysched'] as $pay){
				array_push($paysched,$pay);
			}
			$subjects = array();
			foreach($ass['AssessmentSubject'] as $sub){
				array_push($subjects,$sub['subject_id']);
			}
			$data['payscheds'] = $paysched;
			$data['subjects'] = $subjects;
			$assessments[$i]['Assessment']=$data;
			//pr($ass); exit();
		}
		$this->set('assessments', $assessments);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Assessment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('Assessment', $this->Assessment->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			//pr($this->data); exit();
			$isAdjust = 0;
			$assessment = $this->data['Assessment'];
			if(isset($this->data['Assessment']['difference'])){
				//pr($assessment['difference']);
				$isAdjust = 1;
				$assessment['second']=$assessment['assessment_total']-600;
				$assessment['total']=$assessment['outstanding_balance'];
				
				$account = $this->Account->findById($assessment['id']);
				$account['Account']['assessment_total']-=$assessment['difference'];
				$account['Account']['outstanding_balance']-=$assessment['difference'];
				$assessment['outstanding_balance'] = $account['Account']['outstanding_balance'];
				$assessment['discount_amount'] = $account['Account']['discount_amount'];
				$assessment['payment_total'] = $account['Account']['payment_total'];
				$assessment['assessment_total'] = $assessment['total_adjustment'];
				
				/* $sy = explode('.',$assessment['esp']);
				//$this->Account->save($account['Account']);
				$ledger = array(
					'account_id'=>$assessment['id'],
					'type'=>'-',
					'transaction_type_id'=>'ADJST',
					'esp'=>$sy[0],
					'transac_date'=>date("Y-m-d"),
					'details'=>'Tuition Adjustment',
					'amount'=>$assessment['second']+600
				); */
				//$this->Ledger->save($ledger);
				//pr($this->data);
			}
			
			$assessment['account_type']='student';
			if($assessment['program_id']=='MIXED')
				$assessment['account_details']='Irregular';
			if($isAdjust)
				$assessment['account_details']='Adjust';
			if(!isset($assessment['student_id'])){
				$assessment['student_id']=$assessment['id'];
				$ID = $this->Assessment->generateAID();
				$assessment['id']=$ID;
			}
			$paysched = $this->data['Paysched'];
			$fee = $this->data['Fee'];
			$schedule = $this->data['Schedule'];
			
			$this->Assessment->create();
			$success = $this->Assessment->saveAll($assessment);
			$assess_id = $this->Assessment->id;
			
			$this->AccountSchedule->saveAll($paysched);
			
			foreach($paysched as $i=>$sched){
				$sched['id'] = null;
				$sched['assessment_id'] = $assess_id;
				if(!$isAdjust){
					$sched['bill_month'] = $sched['billing_period_id'];
					$sched['due_date'] = $sched['due_dates'];
					$sched['due_amount'] = $sched['amount'];
				}
				$sched['order'] =$i+1;
				if(!$isAdjust){
					$sched['status'] ='NONE';
					$sched['transaction_type_id'] =$i==0?'INIPY':'SBQPY';
				}
				$paysched[$i] = $sched;
			}
			$this->AssessmentPaysched->saveAll($paysched);
			foreach($fee as $i=>$f){
				$f['assessment_id'] = $assess_id;
				$f['due_amount'] = $f['amount'];
				$fee[$i] = $f;
			}
			$this->AssessmentFee->saveAll($fee);
			foreach($schedule as $i=>$sc){
				$sc['id'] = null;
				$sc['assessment_id'] = $assess_id;
				$schedule[$i] = $sc;
			}
			//pr($schedule);
			$this->AssessmentSubject->saveAll($schedule);
			
			
			if ($success) {
				$this->Session->setFlash(__('The Assessment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Assessment could not be saved. Please, try again.', true));
			}
		}
		$yearLevels = $this->Assessment->YearLevel->find('list');
		$this->set(compact('yearLevels'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Assessment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Assessment->save($this->data)) {
				$this->Session->setFlash(__('The Assessment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Assessment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Assessment->read(null, $id);
		}
		$yearLevels = $this->Assessment->YearLevel->find('list');
		$this->set(compact('yearLevels'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Assessment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Assessment->delete($id)) {
			$this->Session->setFlash(__('Assessment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Assessment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
