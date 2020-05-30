<?php
class CurriculumsController extends AppController {

	var $name = 'Curriculums';
	var $uses = array('Curriculum','CurriculumSection','CurriculumDetail','Subject');

	function index() {
		$this->Curriculum->recursive = 0;
		$curriculums = $this->paginate();
		
		if($this->isAPIRequest()){
			foreach($curriculums as $c=>$curri){
				$details = $curri['CurriculumDetail'];
				$section = $curri['CurriculumSection'];
				$curri['Curriculum']['section_id'] = $section[0]['section_id'];
				$subjects = array();
				foreach($details as $d=>$detail){
					$sub = $this->Subject->find('all',array('recursive'=>0,'conditions'=>array('Subject.id'=>$detail['subject_id'])));
					$subject = $sub[0]['Subject'];
					$dd['subject_id']=$subject['id'];
					$dd['year_level_id']=$detail['year_level_id'];
					$dd['name']=$subject['name'];
					$dd['code']=$subject['alias'];
					array_push($subjects,$dd);
				}
				$curri['Curriculum']['subjects'] = $subjects;
				$curriculums[$c] = $curri;
			}
		}
		//pr($curriculums); exit();
		$this->set('curriculums', $curriculums);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid curriculum', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('curriculum', $this->Curriculum->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Curriculum->create();
			if ($this->Curriculum->save($this->data)) {
				$this->Session->setFlash(__('The curriculum has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The curriculum could not be saved. Please, try again.', true));
			}
		}
		$departments = $this->Curriculum->Department->find('list');
		$this->set(compact('departments'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid curriculum', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Curriculum->save($this->data)) {
				$this->Session->setFlash(__('The curriculum has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The curriculum could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Curriculum->read(null, $id);
		}
		$departments = $this->Curriculum->Department->find('list');
		$this->set(compact('departments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for curriculum', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Curriculum->delete($id)) {
			$this->Session->setFlash(__('Curriculum deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Curriculum was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
