<?php
class AssessmentAdjustmentsController extends AppController {

	var $name = 'AssessmentAdjustments';

	function index() {
		$this->AssessmentAdjustment->recursive = 0;
		$this->set('assessmentAdjustments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid assessment adjustment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('assessmentAdjustment', $this->AssessmentAdjustment->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AssessmentAdjustment->create();
			if ($this->AssessmentAdjustment->save($this->data)) {
				$this->Session->setFlash(__('The assessment adjustment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assessment adjustment could not be saved. Please, try again.', true));
			}
		}
		$assessments = $this->AssessmentAdjustment->Assessment->find('list');
		$this->set(compact('assessments'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid assessment adjustment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AssessmentAdjustment->save($this->data)) {
				$this->Session->setFlash(__('The assessment adjustment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assessment adjustment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AssessmentAdjustment->read(null, $id);
		}
		$assessments = $this->AssessmentAdjustment->Assessment->find('list');
		$this->set(compact('assessments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for assessment adjustment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AssessmentAdjustment->delete($id)) {
			$this->Session->setFlash(__('Assessment adjustment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Assessment adjustment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
