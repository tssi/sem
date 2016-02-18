<?php
class TuitionDiscountsController extends AppController {

	var $name = 'TuitionDiscounts';

	function index() {
		$this->TuitionDiscount->recursive = 0;
		$this->set('tuitionDiscounts', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tuition discount', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tuitionDiscount', $this->TuitionDiscount->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->TuitionDiscount->create();
			if ($this->TuitionDiscount->saveAll($this->data)) {
				$this->Session->setFlash(__('The tuition discount has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tuition discount could not be saved. Please, try again.', true));
			}
		}
		$tuitions = $this->TuitionDiscount->Tuition->find('list');
		$discounts = $this->TuitionDiscount->Discount->find('list');
		$this->set(compact('tuitions', 'discounts'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tuition discount', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TuitionDiscount->save($this->data)) {
				$this->Session->setFlash(__('The tuition discount has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tuition discount could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TuitionDiscount->read(null, $id);
		}
		$tuitions = $this->TuitionDiscount->Tuition->find('list');
		$discounts = $this->TuitionDiscount->Discount->find('list');
		$this->set(compact('tuitions', 'discounts'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tuition discount', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TuitionDiscount->delete($id)) {
			$this->Session->setFlash(__('Tuition discount deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tuition discount was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
