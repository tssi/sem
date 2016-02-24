<?php
class AssessmentFeesController extends AppController {

	var $name = 'AssessmentFees';

	function index() {
		$this->AssessmentFee->recursive = 0;
		$this->set('assessmentFees', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid assessment fee', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('assessmentFee', $this->AssessmentFee->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AssessmentFee->create();
			if ($this->AssessmentFee->save($this->data)) {
				$this->Session->setFlash(__('The assessment fee has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assessment fee could not be saved. Please, try again.', true));
			}
		}
		$assessments = $this->AssessmentFee->Assessment->find('list');
		$fees = $this->AssessmentFee->Fee->find('list');
		$this->set(compact('assessments', 'fees'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid assessment fee', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AssessmentFee->save($this->data)) {
				$this->Session->setFlash(__('The assessment fee has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assessment fee could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AssessmentFee->read(null, $id);
		}
		$assessments = $this->AssessmentFee->Assessment->find('list');
		$fees = $this->AssessmentFee->Fee->find('list');
		$this->set(compact('assessments', 'fees'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for assessment fee', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AssessmentFee->delete($id)) {
			$this->Session->setFlash(__('Assessment fee deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Assessment fee was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
