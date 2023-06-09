<?php
class CurriculumSectionsController extends AppController {

	var $name = 'CurriculumSections';
	var $uses = array('CurriculumSection', 'Section');

	function index() {
		$this->CurriculumSection->recursive = 0;
		$curriculumSections = $this->paginate();
		
		if($this->isAPIRequest()){
			foreach($curriculumSections as $csi=>$curriculumSection){
				$CS = $curriculumSection['CurriculumSection'];
				$section = $curriculumSection['Section'];
				
				$CS['section']=$section['name'];
				$CS['year_level_id']=$section['YearLevel']['id'];
				$CS['year_level']=$section['YearLevel']['description'];
				$CS['alias'] = $curriculumSection['Curriculum']['alias'];
				$sem = null;
				if(isset($_GET['sy'])){
					switch($CS['esp']){
						case $_GET['sy'].'.25': $sem = '1st Semester'; break;
						case $_GET['sy'].'.45': $sem = '2nd Semester'; break;
					}
					$CS['sem'] = $sem;
				}
				//pr($curriculumSection); exit();
				$curriculumSections[$csi]['CurriculumSection']=$CS;
			}
		}
		$this->set('curriculumSections', $curriculumSections);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid curriculum section', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('curriculumSection', $this->CurriculumSection->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$curri_sec = $this->data['CurriculumSection'];
			
			if(isset($curri_sec['mode'])){
				$new_currisecs = array();
				$sy = $curri_sec['sy']['id'];
				$prev_sy = $sy-1;
				foreach($curri_sec['curri'] as $i=>$c){
					$data['section_id'] = $c['section_id'];
					$data['curriculum_id'] = $c['curriculum_id'];
					if($c['esp']==$prev_sy.'.25')
						$data['esp'] = $sy.'.25';
					else
						$data['esp'] = $sy.'.45';
					array_push($new_currisecs,$data);
				}
				$success = $this->CurriculumSection->saveAll($new_currisecs);
			}else{
				if($curri_sec['department_id']=='SH'){
					if(isset($curri_sec['first_sem'])){
						if(!isset($curri_sec['first_sem']['id'])){
						$first['esp'] = $curri_sec['sy'] . '.25';
						$first['curriculum_id'] = $curri_sec['first_sem']['curriculum_id'];
						$first['section_id'] = $curri_sec['id'];
						}else{
							$first = $curri_sec['first_sem'];
						}
						$this->CurriculumSection->create();
						$success = $this->CurriculumSection->save($first);
					}
					if(isset($curri_sec['second_sem'])){
						if(!isset($curri_sec['second_sem']['id'])){
							$second['esp'] = $curri_sec['sy'] . '.45';
							$second['curriculum_id'] = $curri_sec['second_sem']['curriculum_id'];
							$second['section_id'] = $curri_sec['id'];
						}else{
							$second = $curri_sec['second_sem'];
						}
						
						$this->CurriculumSection->create();
						$success = $this->CurriculumSection->save($second);
					
				
					}
				}
			}
			
			if ($success) {
				$this->Session->setFlash(__('The curriculum section has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The curriculum section could not be saved. Please, try again.', true));
			}
		}
		$sections = $this->CurriculumSection->Section->find('list');
		$curriculums = $this->CurriculumSection->Curriculum->find('list');
		$this->set(compact('sections', 'curriculums'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid curriculum section', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CurriculumSection->save($this->data)) {
				$this->Session->setFlash(__('The curriculum section has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The curriculum section could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CurriculumSection->read(null, $id);
		}
		$sections = $this->CurriculumSection->Section->find('list');
		$curriculums = $this->CurriculumSection->Curriculum->find('list');
		$this->set(compact('sections', 'curriculums'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for curriculum section', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CurriculumSection->delete($id)) {
			$this->Session->setFlash(__('Curriculum section deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Curriculum section was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
