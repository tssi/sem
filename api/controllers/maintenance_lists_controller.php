<?php
class MaintenanceListsController extends AppController {

	var $name = 'MaintenanceLists';
	function index() {
		$this->MaintenanceList->recursive = 0;
		$this->set('maintenanceLists', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid maintenance list', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('maintenanceList', $this->MaintenanceList->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->MaintenanceList->create();
			if ($this->MaintenanceList->saveAll($this->data)) {
				if(isset($this->data['MaintenanceList']['path']))
					$this->data['MaintenanceList']['schema'] = $this->MaintenanceList->getSchema($this->data['MaintenanceList']['path']);
				$this->Session->setFlash(__('The maintenance list has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The maintenance list could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid maintenance list', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->MaintenanceList->save($this->data)) {
				$this->Session->setFlash(__('The maintenance list has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The maintenance list could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MaintenanceList->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for maintenance list', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->MaintenanceList->delete($id)) {
			$this->Session->setFlash(__('Maintenance list deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Maintenance list was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
