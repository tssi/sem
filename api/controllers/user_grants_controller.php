<?php
class UserGrantsController extends AppController {

	var $name = 'UserGrants';

	function index() {
		$this->UserGrant->recursive = 0;
		$this->set('userGrants', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user grant', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userGrant', $this->UserGrant->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->UserGrant->create();
			if ($this->UserGrant->save($this->data)) {
				$this->Session->setFlash(__('The user grant has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user grant could not be saved. Please, try again.', true));
			}
		}
		$userTypes = $this->UserGrant->UserType->find('list');
		$masterModules = $this->UserGrant->MasterModule->find('list');
		$this->set(compact('userTypes', 'masterModules'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user grant', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserGrant->save($this->data)) {
				$this->Session->setFlash(__('The user grant has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user grant could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserGrant->read(null, $id);
		}
		$userTypes = $this->UserGrant->UserType->find('list');
		$masterModules = $this->UserGrant->MasterModule->find('list');
		$this->set(compact('userTypes', 'masterModules'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user grant', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UserGrant->delete($id)) {
			$this->Session->setFlash(__('User grant deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User grant was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
