<?php
class CitizenshipsController extends AppController {

	var $name = 'Citizenships';

	function index() {
		$this->Citizenship->recursive = 0;
		$this->set('citizenships', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid citizenship', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('citizenship', $this->Citizenship->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Citizenship->create();
			if ($this->Citizenship->saveAll($this->data)) {
				$this->Session->setFlash(__('The citizenship has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The citizenship could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid citizenship', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Citizenship->save($this->data)) {
				$this->Session->setFlash(__('The citizenship has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The citizenship could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Citizenship->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for citizenship', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Citizenship->delete($id)) {
			$this->Session->setFlash(__('Citizenship deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Citizenship was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
