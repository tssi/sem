<?php
class AssessmentPayschedsController extends AppController {

	var $name = 'AssessmentPayscheds';

	function index() {
		$this->AssessmentPaysched->recursive = 0;
		$this->set('assessmentPayscheds', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid AssessmentPaysched', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('AssessmentPaysched', $this->AssessmentPaysched->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AssessmentPaysched->create();
			if ($this->AssessmentPaysched->save($this->data)) {
				$this->Session->setFlash(__('The AssessmentPaysched has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The AssessmentPaysched could not be saved. Please, try again.', true));
			}
		}
		$yearLevels = $this->AssessmentPaysched->YearLevel->find('list');
		$this->set(compact('yearLevels'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid AssessmentPaysched', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AssessmentPaysched->save($this->data)) {
				$this->Session->setFlash(__('The AssessmentPaysched has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The AssessmentPaysched could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AssessmentPaysched->read(null, $id);
		}
		$yearLevels = $this->AssessmentPaysched->YearLevel->find('list');
		$this->set(compact('yearLevels'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for AssessmentPaysched', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AssessmentPaysched->delete($id)) {
			$this->Session->setFlash(__('AssessmentPaysched deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('AssessmentPaysched was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
