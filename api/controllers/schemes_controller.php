<?php
class SchemesController extends AppController {

	var $name = 'Schemes';

	function index() {
		$this->Scheme->recursive = 0;
		$this->set('schemes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid scheme', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('scheme', $this->Scheme->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Scheme->create();
			if ($this->Scheme->saveAll($this->data)) {
				$this->Session->setFlash(__('The scheme has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The scheme could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid scheme', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Scheme->save($this->data)) {
				$this->Session->setFlash(__('The scheme has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The scheme could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Scheme->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for scheme', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Scheme->delete($id)) {
			$this->Session->setFlash(__('Scheme deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Scheme was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
