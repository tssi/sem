<?php
class TuitionsController extends AppController {

	var $name = 'Tuitions';

	function index() {
		$this->Tuition->recursive = 2;
		$tuitions = $this->paginate();
		if($this->isAPIRequest()){
			foreach($tuitions as $i=>$tui){
				//pr($tui);
				$tuition = $tui['Tuition'];
				$fees = $tui['FeeBreakdown'];
				$pschemes = $tui['PaymentScheme'];
				$discount = $tui['Discount'];
				$fee_breakdowns = array();
				$schemes = array();
				foreach($fees as $f=>$fee){
					//pr($fee);
					$fe['fee_id'] = $fee['fee_id'];
					$fe['amount'] = $fee['amount'];
					$fe['description'] = $fee['Fee']['name'];
					$fe['type'] = $fee['Fee']['type'];
					$fe['order'] = $fee['Fee']['order'];
					array_push($fee_breakdowns,$fe);
				}
				foreach($pschemes as $p=>$scheme){
					//pr($scheme); exit();
					$sch['id'] = $scheme['id'];
					$sch['name'] = $scheme['Scheme']['name'];
					$sch['scheme_id'] = $scheme['scheme_id'];
					$sch['subsidy_status'] = $scheme['Scheme']['subsidy_status'];
					$sch['total_amount'] = $scheme['total_amount'];
					$sch['payment_frequency'] = $scheme['Scheme']['payment_frequency'];
					$sch['variance_amount'] = $scheme['variance_amount'];
					$schedules = array();
					$sched = $scheme['PaymentSchemeSchedule'];
					foreach($sched as $s=>$sc){
						array_push($schedules,$sc);
					}
					if(count($schedules)==0):
						$totalAmount = $scheme['total_amount'];
						$initialPayment = 5000;
						$billStart = '2024-08-15';
						$billEnd = '2025-05-15';
						$schedules = $this->Tuition->PaymentScheme->buildPaysched($totalAmount,$initialPayment,$billStart,$billEnd);
					endif;

					$sch['schedule'] = $schedules;
					array_push($schemes,$sch);
				}
				
				//pr($tui); exit();
				$tuition['fee_breakdowns'] = $fee_breakdowns;
				$tuition['schemes'] = $schemes;
				$tuition['discounts'] = $discount;
				$tuitions[$i]['Tuition'] = $tuition;

			}
		}
		$this->set('tuitions', $tuitions);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tuition', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tuition', $this->Tuition->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Tuition->create();
			if ($this->Tuition->save($this->data)) {
				$this->Session->setFlash(__('The tuition has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tuition could not be saved. Please, try again.', true));
			}
		}
		$yearLevels = $this->Tuition->YearLevel->find('list');
		$this->set(compact('yearLevels'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tuition', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tuition->save($this->data)) {
				$this->Session->setFlash(__('The tuition has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tuition could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tuition->read(null, $id);
		}
		$yearLevels = $this->Tuition->YearLevel->find('list');
		$this->set(compact('yearLevels'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tuition', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tuition->delete($id)) {
			$this->Session->setFlash(__('Tuition deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tuition was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
