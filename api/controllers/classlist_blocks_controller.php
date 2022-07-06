<?php
class ClasslistBlocksController extends AppController {

	var $name = 'ClasslistBlocks';

	function index() {
		$this->ClasslistBlock->recursive = 0;
		$this->set('classlistBlocks', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ClasslistBlock', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('classlistBlock', $this->ClasslistBlock->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ClasslistBlock->create();
			if ($this->ClasslistBlock->save($this->data)) {
				$this->Session->setFlash(__('The ClasslistBlock has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ClasslistBlock could not be saved. Please, try again.', true));
			}
		}
		$departments = $this->ClasslistBlock->Department->find('list');
		$yearLevels = $this->ClasslistBlock->YearLevel->find('list');
		$this->set(compact('departments', 'yearLevels'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ClasslistBlock', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ClasslistBlock->save($this->data)) {
				$this->Session->setFlash(__('The ClasslistBlock has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ClasslistBlock could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ClasslistBlock->read(null, $id);
		}
		$departments = $this->ClasslistBlock->Department->find('list');
		$yearLevels = $this->ClasslistBlock->YearLevel->find('list');
		$this->set(compact('departments', 'yearLevels'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ClasslistBlock', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ClasslistBlock->delete($id)) {
			$this->Session->setFlash(__('ClasslistBlock deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('ClasslistBlock was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
