<?php
class FeeBreakdownsController extends AppController {

	var $name = 'FeeBreakdowns';

	function index() {
		$this->FeeBreakdown->recursive = 0;
		$this->set('feeBreakdowns', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fee breakdown', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('feeBreakdown', $this->FeeBreakdown->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->FeeBreakdown->create();
			if ($this->FeeBreakdown->save($this->data)) {
				$this->Session->setFlash(__('The fee breakdown has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fee breakdown could not be saved. Please, try again.', true));
			}
		}
		$tuitions = $this->FeeBreakdown->Tuition->find('list');
		$fees = $this->FeeBreakdown->Fee->find('list');
		$this->set(compact('tuitions', 'fees'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fee breakdown', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FeeBreakdown->save($this->data)) {
				$this->Session->setFlash(__('The fee breakdown has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fee breakdown could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FeeBreakdown->read(null, $id);
		}
		$tuitions = $this->FeeBreakdown->Tuition->find('list');
		$fees = $this->FeeBreakdown->Fee->find('list');
		$this->set(compact('tuitions', 'fees'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fee breakdown', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FeeBreakdown->delete($id)) {
			$this->Session->setFlash(__('Fee breakdown deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fee breakdown was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
