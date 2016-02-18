<?php
class PaymentSchemesController extends AppController {

	var $name = 'PaymentSchemes';

	function index() {
		$this->PaymentScheme->recursive = 0;
		$this->set('paymentSchemes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid payment scheme', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('paymentScheme', $this->PaymentScheme->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->data = $this->PaymentScheme->prepareData($this->data);
			if ($this->PaymentScheme->saveAll($this->data)) {
				$this->Session->setFlash(__('The payment scheme has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment scheme could not be saved. Please, try again.', true));
			}
		}
		$tuitions = $this->PaymentScheme->Tuition->find('list');
		$schemes = $this->PaymentScheme->Scheme->find('list');
		$this->set(compact('tuitions', 'schemes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid payment scheme', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->data = $this->PaymentScheme->prepareData($this->data);
			if ($this->PaymentScheme->saveAll($this->data)) {
				$this->Session->setFlash(__('The payment scheme has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment scheme could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PaymentScheme->read(null, $id);
		}
		$tuitions = $this->PaymentScheme->Tuition->find('list');
		$schemes = $this->PaymentScheme->Scheme->find('list');
		$this->set(compact('tuitions', 'schemes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for payment scheme', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PaymentScheme->delete($id)) {
			$this->Session->setFlash(__('Payment scheme deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Payment scheme was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
