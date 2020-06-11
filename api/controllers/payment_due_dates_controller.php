<?php
class PaymentDueDatesController extends AppController {

	var $name = 'PaymentDueDates';

	function index() {
		$this->PaymentDueDate->recursive = 0;
		$this->set('paymentDueDates', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid payment due date', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('paymentDueDate', $this->PaymentDueDate->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PaymentDueDate->create();
			if ($this->PaymentDueDate->save($this->data)) {
				$this->Session->setFlash(__('The payment due date has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment due date could not be saved. Please, try again.', true));
			}
		}
		$schemes = $this->PaymentDueDate->Scheme->find('list');
		$this->set(compact('schemes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid payment due date', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PaymentDueDate->save($this->data)) {
				$this->Session->setFlash(__('The payment due date has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment due date could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PaymentDueDate->read(null, $id);
		}
		$schemes = $this->PaymentDueDate->Scheme->find('list');
		$this->set(compact('schemes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for payment due date', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PaymentDueDate->delete($id)) {
			$this->Session->setFlash(__('Payment due date deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Payment due date was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
