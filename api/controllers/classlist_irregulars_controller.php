<?php
class ClasslistIrregularsController extends AppController {

	var $name = 'ClasslistIrregulars';
	var $uses = array('ClasslistIrregular', 'Section');

	function index() {
		$this->ClasslistIrregular->recursive = 0;
		$classlistIrregulars = $this->paginate();
		
		if($this->isAPIRequest()){
			foreach($classlistIrregulars as $i =>$CLI){
				$student = $CLI['Student'];
				$CLI['ClasslistIrregular']['sno']= $student['sno'];
				$CLI['ClasslistIrregular']['name']= $student['full_name'];
				$CLI['ClasslistIrregular']['gender']=$student['gender'];
				
				$section = $CLI['Section'];
				$subject_id = $CLI['ClasslistIrregular']['subject_id'];
				//$CLI['ClasslistIrregular']['department_id']=$section['YearLevel']['department_id'];
				$CLI['ClasslistIrregular']['year_level_id']=$section['YearLevel']['id'];
				$CLI['ClasslistIrregular']['section']=$section['YearLevel']['alias'].' '.$section['name'];
				$CLI['ClasslistIrregular']['subject']=$subject_id=='ALL'?'All':$CLI['Subject']['alias'] . ' | ' . $CLI['Subject']['name'];
				
				$classlistIrregulars[$i]=$CLI;
			}
		}
		$this->set('classlistIrregulars', $classlistIrregulars);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid classlist irregular', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('classlistIrregular', $this->ClasslistIrregular->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ClasslistIrregular->create();
			if ($this->ClasslistIrregular->save($this->data)) {
				$this->Session->setFlash(__('The classlist irregular has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The classlist irregular could not be saved. Please, try again.', true));
			}
		}
		$students = $this->ClasslistIrregular->Student->find('list');
		$sections = $this->ClasslistIrregular->Section->find('list');
		$subjects = $this->ClasslistIrregular->Subject->find('list');
		$this->set(compact('students', 'sections', 'subjects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid classlist irregular', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ClasslistIrregular->save($this->data)) {
				$this->Session->setFlash(__('The classlist irregular has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The classlist irregular could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ClasslistIrregular->read(null, $id);
		}
		$students = $this->ClasslistIrregular->Student->find('list');
		$sections = $this->ClasslistIrregular->Section->find('list');
		$subjects = $this->ClasslistIrregular->Subject->find('list');
		$this->set(compact('students', 'sections', 'subjects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for classlist irregular', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ClasslistIrregular->delete($id)) {
			$this->Session->setFlash(__('Classlist irregular deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Classlist irregular was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
