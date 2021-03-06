<?php
class AssessmentFeesController extends AppController {

	var $name = 'AssessmentFees';

	function index() {
		$this->AssessmentFee->recursive = 0;
		$this->set('assessmentFees', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid AssessmentFee', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('assessmentFee', $this->AssessmentFee->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AssessmentFee->create();
			if ($this->AssessmentFee->save($this->data)) {
				$this->Session->setFlash(__('The AssessmentFee has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The AssessmentFee could not be saved. Please, try again.', true));
			}
		}
		$yearLevels = $this->AssessmentFee->YearLevel->find('list');
		$this->set(compact('yearLevels'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid AssessmentFee', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AssessmentFee->save($this->data)) {
				$this->Session->setFlash(__('The AssessmentFee has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The AssessmentFee could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AssessmentFee->read(null, $id);
		}
		$yearLevels = $this->AssessmentFee->YearLevel->find('list');
		$this->set(compact('yearLevels'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for AssessmentFee', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AssessmentFee->delete($id)) {
			$this->Session->setFlash(__('AssessmentFee deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('AssessmentFee was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
