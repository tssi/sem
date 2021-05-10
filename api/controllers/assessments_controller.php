<?php
class AssessmentsController extends AppController {

	var $name = 'Assessments';
	var $uses = array('Assessment','AssessmentFee','AssessmentPaysched','AssessmentSubject');

	function index() {
		$this->Assessment->recursive = 0;
		$this->set('assessments', $this->paginate());
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
			$assessment = $this->data['Assessment'];
			$assessment['account_type']='student';
			if(!isset($assessment['student_id']))
				$assessment['student_id']=$assessment['id'];
			$ID = $this->Assessment->generateAID();
			$assessment['id']=$ID;
			$paysched = $this->data['Paysched'];
			$fee = $this->data['Fee'];
			$schedule = $this->data['Schedule'];
			
			$this->Assessment->create();
			$success = $this->Assessment->saveAll($assessment);
			$assess_id = $this->Assessment->id;
			foreach($paysched as $i=>$sched){
				$sched['id'] = null;
				$sched['assessment_id'] = $assess_id;
				$sched['bill_month'] = $sched['billing_period_id'];
				$sched['due_date'] = $sched['due_dates'];
				$sched['due_amount'] = $sched['amount'];
				$sched['order'] =$i+1;
				$sched['status'] ='NONE';
				$sched['transaction_type_id'] =$i==0?'INIPY':'SBQPY';
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
