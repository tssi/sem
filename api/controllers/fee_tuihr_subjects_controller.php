<?php
class FeeTuihrSubjectsController extends AppController {

	var $name = 'FeeTuihrSubjects';

	function index() {
		$this->FeeTuihrSubject->recursive = 0;
		
		$this->set('feeTuihrSubjects', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid FeeTuihrSubjects', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('feeTuihrSubjects', $this->FeeTuihrSubject->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->FeeTuihrSubjects->create();
			if ($this->FeeTuihrSubject->save($this->data)) {
				$this->Session->setFlash(__('The FeeTuihrSubjects has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The FeeTuihrSubjects could not be saved. Please, try again.', true));
			}
		}
		
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid FeeTuihrSubjects', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FeeTuihrSubject->save($this->data)) {
				$this->Session->setFlash(__('The FeeTuihrSubjects has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The FeeTuihrSubjects could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FeeTuihrSubject->read(null, $id);
		}
		
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for FeeTuihrSubjects', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FeeTuihrSubjects->delete($id)) {
			$this->Session->setFlash(__('FeeTuihrSubjects deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('FeeTuihrSubjects was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
