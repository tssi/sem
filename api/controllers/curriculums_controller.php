<?php
class CurriculumsController extends AppController {

	var $name = 'Curriculums';
	var $uses =  array('Curriculum','MasterConfig');
	function index() {
		$this->Curriculum->recursive = 0;
		$curriculums = $this->paginate();
		//pr($curriculums);exit;
		if($this->isAPIRequest()){
			
			
			foreach($curriculums as $ci=>$curriculum){
				
				$all = array();
				$count = 0;
				$C =  $curriculum['Curriculum'];
				$details = $curriculum['CurriculumDetail'];
				$sec = $curriculum['CurriculumSection'];
				//pr($curriculum);

				$subjects = array();
				foreach($details as $detail){
					
					$year_level = $detail['year_level_id'];
					$code = $detail['subject_id'];
					$alt = $detail['alt_subject_id'];
					if($alt):
						$detail['Subject'] =  $detail['AlternateSubject'];
					endif;
					$name = $detail['Subject']['name'];
					$desc = $detail['Subject']['description']; 
					$alias = $detail['Subject']['alias']; 
					 

					$under = $detail['under'];
					$weight= $detail['weight'];
					$child = !$detail['is_parent'];
					$indention = $detail['indention'];
					$subject = array(
						'year_level_id'=>$year_level,
						'code'=>$code,
						'name'=>$name,
						'description'=>$desc,
						'alias'=>$alias,
						'under'=>$under,
						'weight'=>$weight,
						'child'=>$child,
						'indention'=>$indention,
						'order'=>$detail['order']
					);
					
					array_push($subjects,$subject);
					
				}
				$C['subjects']=$subjects;
				$curriculums[$ci]['Curriculum']=$C;
			}
			
		}
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
