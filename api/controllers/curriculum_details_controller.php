<?php
class CurriculumDetailsController extends AppController {

	var $name = 'CurriculumDetails';

	function index() {
		$this->CurriculumDetail->recursive = 0;
		$this->set('curriculumDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid curriculum detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('curriculumDetail', $this->CurriculumDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CurriculumDetail->create();
			if ($this->CurriculumDetail->save($this->data)) {
				$this->Session->setFlash(__('The curriculum detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The curriculum detail could not be saved. Please, try again.', true));
			}
		}
		$curriculums = $this->CurriculumDetail->Curriculum->find('list');
		$yearLevels = $this->CurriculumDetail->YearLevel->find('list');
		$subjects = $this->CurriculumDetail->Subject->find('list');
		$this->set(compact('curriculums', 'yearLevels', 'subjects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid curriculum detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CurriculumDetail->save($this->data)) {
				$this->Session->setFlash(__('The curriculum detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The curriculum detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CurriculumDetail->read(null, $id);
		}
		$curriculums = $this->CurriculumDetail->Curriculum->find('list');
		$yearLevels = $this->CurriculumDetail->YearLevel->find('list');
		$subjects = $this->CurriculumDetail->Subject->find('list');
		$this->set(compact('curriculums', 'yearLevels', 'subjects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for curriculum detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CurriculumDetail->delete($id)) {
			$this->Session->setFlash(__('Curriculum detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Curriculum detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
