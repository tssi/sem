<?php
class TransactionTypeController extends AppController {

	var $name = 'TransactionTypes';

	function index() {
		$this->TransactionDetail->recursive = 0;
		$this->set('transactionType',$this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid TransactionDetail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('transactionType', $this->TransactionDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->TransactionDetail->create();
			if ($this->TransactionDetail->save($this->data)) {
				$this->Session->setFlash(__('The TransactionDetail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The TransactionDetail could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid TransactionDetail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TransactionDetail->save($this->data)) {
				$this->Session->setFlash(__('The TransactionDetail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The TransactionDetail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TransactionDetail->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for TransactionDetail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->transactionType->delete($id)) {
			$this->Session->setFlash(__('TransactionDetail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('TransactionDetail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
