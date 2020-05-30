<?php
class MasterConfigsController extends AppController {

	var $name = 'MasterConfigs';

	function index() {
		$this->MasterConfig->recursive = 0;
		$this->set('masterConfigs', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid master config', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('masterConfig', $this->MasterConfig->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->MasterConfig->create();
			if ($this->MasterConfig->save($this->data)) {
				$this->Session->setFlash(__('The master config has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The master config could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid master config', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->MasterConfig->save($this->data)) {
				$this->Session->setFlash(__('The master config has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The master config could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MasterConfig->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for master config', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->MasterConfig->delete($id)) {
			$this->Session->setFlash(__('Master config deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Master config was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
