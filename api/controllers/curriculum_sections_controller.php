<?php
class CurriculumSectionsController extends AppController {

	var $name = 'CurriculumSections';

	function index() {
		$this->CurriculumSection->recursive = 0;
		$this->set('curriculumSections', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid curriculum section', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('curriculumSection', $this->CurriculumSection->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CurriculumSection->create();
			if ($this->CurriculumSection->save($this->data)) {
				$this->Session->setFlash(__('The curriculum section has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The curriculum section could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid curriculum section', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CurriculumSection->save($this->data)) {
				$this->Session->setFlash(__('The curriculum section has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The curriculum section could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CurriculumSection->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for curriculum section', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CurriculumSection->delete($id)) {
			$this->Session->setFlash(__('Curriculum section deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Curriculum section was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
