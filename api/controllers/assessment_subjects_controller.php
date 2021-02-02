<?php
class AssessmentSubjectsController extends AppController {

	var $name = 'AssessmentSubjects';

	function index() {
		$this->AssessmentSubject->recursive = 0;
		$this->set('assessmentSubjects', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid AssessmentSubject', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('AssessmentSubject', $this->AssessmentSubject->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AssessmentSubject->create();
			if ($this->AssessmentSubject->save($this->data)) {
				$this->Session->setFlash(__('The AssessmentSubject has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The AssessmentSubject could not be saved. Please, try again.', true));
			}
		}
		$yearLevels = $this->AssessmentSubject->YearLevel->find('list');
		$this->set(compact('yearLevels'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid AssessmentSubject', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AssessmentSubject->save($this->data)) {
				$this->Session->setFlash(__('The AssessmentSubject has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The AssessmentSubject could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AssessmentSubject->read(null, $id);
		}
		$yearLevels = $this->AssessmentSubject->YearLevel->find('list');
		$this->set(compact('yearLevels'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for AssessmentSubject', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AssessmentSubject->delete($id)) {
			$this->Session->setFlash(__('AssessmentSubject deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('AssessmentSubject was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
