<?php
class BillingPeriodsController extends AppController {

	var $name = 'BillingPeriods';

	function index() {
		$this->BillingPeriod->recursive = 0;
		$this->set('billingPeriods', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid billing period', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('billingPeriod', $this->BillingPeriod->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->BillingPeriod->create();
			if ($this->BillingPeriod->saveAll($this->data)) {
				$this->Session->setFlash(__('The billing period has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The billing period could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid billing period', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->BillingPeriod->save($this->data)) {
				$this->Session->setFlash(__('The billing period has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The billing period could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->BillingPeriod->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for billing period', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->BillingPeriod->delete($id)) {
			$this->Session->setFlash(__('Billing period deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Billing period was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
