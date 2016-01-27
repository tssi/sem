<?php
class FamiliesController extends AppController {

	var $name = 'Families';

	function index() {
		$this->Family->recursive = 0;
		$this->set('families', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid family', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('family', $this->Family->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Family->create();
			if ($this->Family->save($this->data)) {
				$this->Session->setFlash(__('The family has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The family could not be saved. Please, try again.', true));
			}
		}
		$students = $this->Family->Student->find('list');
		$this->set(compact('students'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid family', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Family->save($this->data)) {
				$this->Session->setFlash(__('The family has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The family could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Family->read(null, $id);
		}
		$students = $this->Family->Student->find('list');
		$this->set(compact('students'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for family', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Family->delete($id)) {
			$this->Session->setFlash(__('Family deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Family was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
