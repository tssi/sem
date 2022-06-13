<?php
class SectionsController extends AppController {

	var $name = 'Sections';

	function index() {
		$this->Section->recursive = 1;
		$this->paginate['Section']['contain'] = array('Department','Program','YearLevel');
		$sections = $this->paginate();
		if($this->isAPIRequest()){
			foreach($sections as $i=>$sec){
				//pr($sec); exit();
				$sec['Section']['year_level'] = $sec['YearLevel']['name'];
				$sc = $sec['Section'];
				$sc['year_level'] = $sec['YearLevel']['name'];
				$sc['program'] = $sec['Program']['name'];
				
				$sections[$i]['Section'] = $sc;
			}
		}
		//exit();
		$this->set('sections', $sections);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid section', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('section', $this->Section->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Section->create();
			if ($this->Section->save($this->data)) {
				$this->Session->setFlash(__('The section has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The section could not be saved. Please, try again.', true));
			}
		}
		$departments = $this->Section->Department->find('list');
		$yearLevels = $this->Section->YearLevel->find('list');
		$programs = $this->Section->Program->find('list');
		$this->set(compact('departments', 'yearLevels', 'programs'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid section', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Section->save($this->data)) {
				$this->Session->setFlash(__('The section has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The section could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Section->read(null, $id);
		}
		$departments = $this->Section->Department->find('list');
		$yearLevels = $this->Section->YearLevel->find('list');
		$programs = $this->Section->Program->find('list');
		$this->set(compact('departments', 'yearLevels', 'programs'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for section', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Section->delete($id)) {
			$this->Session->setFlash(__('Section deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Section was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
