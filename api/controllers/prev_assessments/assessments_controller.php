<?php
class AssessmentsController extends AppController {

	var $name = 'Assessments';

	function index() {
		$this->Assessment->recursive = 0;
		$this->set('assessments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid assessment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('assessment', $this->Assessment->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Assessment->create();
			$this->data =  $this->Assessment->prepareData($this->data);
			if ($this->Assessment->saveAll($this->data)) {
				$this->Session->setFlash(__('The assessment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assessment could not be saved. Please, try again.', true));
			}
		}
		$students = $this->Assessment->Student->find('list');
		$sections = $this->Assessment->Section->find('list');
		$tuitions = $this->Assessment->Tuition->find('list');
		$schemes = $this->Assessment->Scheme->find('list');
		$this->set(compact('students', 'sections', 'tuitions', 'schemes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid assessment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Assessment->save($this->data)) {
				$this->Session->setFlash(__('The assessment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assessment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Assessment->read(null, $id);
		}
		$students = $this->Assessment->Student->find('list');
		$sections = $this->Assessment->Section->find('list');
		$tuitions = $this->Assessment->Tuition->find('list');
		$schemes = $this->Assessment->Scheme->find('list');
		$this->set(compact('students', 'sections', 'tuitions', 'schemes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for assessment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Assessment->delete($id)) {
			$this->Session->setFlash(__('Assessment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Assessment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
