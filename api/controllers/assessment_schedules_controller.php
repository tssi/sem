<?php
class AssessmentSchedulesController extends AppController {

	var $name = 'AssessmentSchedules';

	function index() {
		$this->AssessmentSchedule->recursive = 0;
		$this->set('assessmentSchedules', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid assessment schedule', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('assessmentSchedule', $this->AssessmentSchedule->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AssessmentSchedule->create();
			if ($this->AssessmentSchedule->save($this->data)) {
				$this->Session->setFlash(__('The assessment schedule has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assessment schedule could not be saved. Please, try again.', true));
			}
		}
		$assessments = $this->AssessmentSchedule->Assessment->find('list');
		$this->set(compact('assessments'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid assessment schedule', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AssessmentSchedule->save($this->data)) {
				$this->Session->setFlash(__('The assessment schedule has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assessment schedule could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AssessmentSchedule->read(null, $id);
		}
		$assessments = $this->AssessmentSchedule->Assessment->find('list');
		$this->set(compact('assessments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for assessment schedule', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AssessmentSchedule->delete($id)) {
			$this->Session->setFlash(__('Assessment schedule deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Assessment schedule was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
