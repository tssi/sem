<?php
class ContactNumbersController extends AppController {

	var $name = 'ContactNumbers';

	function index() {
		$this->ContactNumber->recursive = 0;
		$this->set('contactNumbers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid contact number', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('contactNumber', $this->ContactNumber->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ContactNumber->create();
			if ($this->ContactNumber->save($this->data)) {
				$this->Session->setFlash(__('The contact number has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contact number could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid contact number', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ContactNumber->save($this->data)) {
				$this->Session->setFlash(__('The contact number has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contact number could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ContactNumber->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for contact number', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ContactNumber->delete($id)) {
			$this->Session->setFlash(__('Contact number deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Contact number was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
