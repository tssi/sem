<?php
class StudentsController extends AppController {

	var $name = 'Students';
	function index() {
		$this->Student->recursive = 0;
		$students = $this->paginate();
		
		foreach($students as $i=>$s){
			//pr($s); exit();
			if(!isset($s['Account']['subsidy_status'])){
				//pr($s); exit();
				continue;
			}
			
			if(isset($s['YearLevel']['Section'][0]['department_id']))
				$s['Student']['department_id'] = $s['YearLevel']['Section'][0]['department_id'];
			
			$s['Student']['subsidy_status'] = $s['Account']['subsidy_status'];
			$s['Student']['year_level'] = $s['YearLevel']['name'];
			
			$students[$i]=$s;
			//pr($s);exit;
		}
		// /pr($students);
		$this->set('students', $students);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid student', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('student', $this->Student->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			//pr($this->data);exit;
			$student = $this->data['Student'];
			$this->Student->create();
			if(!isset($student['id'])){
				$SID_CODE ='X';
				if(!isset($student['section_id'])):
					$student['section_id'] = 9999;
					$student['program_id'] = 'MIXED';
					$student['year_level_id'] = 'GZ';
				else:
					$sectObj = $this->Student->Section->findById($student['section_id'])['Section'];
					$student['year_level_id'] =$sectObj['year_level_id'];
					$student['program_id'] =$sectObj['program_id'];
					
					switch($sectObj['department_id']){
						case 'SH': $SID_CODE='S'; break;
						case 'HS': $SID_CODE='J'; break;
						case 'GS': $SID_CODE='G'; break;
						case 'PS': $SID_CODE='P'; break;
					}

				endif;

				$student['id'] = $this->Student->generateSID('LS',$SID_CODE);
				if(!isset($student['suffix']))
					$student['suffix'] = '';
				if(!isset($student['prefix']))
					$student['prefix'] = '';
			}
			$this->data['Student'] = $student;
			if ($this->Student->save($this->data)) {
				if(isset($this->data['Student']['classroom_user_id']))
					$this->data['Student']['classroom_user_id'] = '_'.$this->data['Student']['classroom_user_id'];
				if(isset($this->data['Student']['__add_to_block'])):
					$CLB =  array(
								'student_id'=>$this->Student->id,
								'esp'=>2019.3,
								'section_id'=>999,
								'status'=>'ACT'
								);

					$this->Student->ClasslistBlock->save($CLB);
				endif;
				$this->Session->setFlash(__('The student has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The student could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid student', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Student->save($this->data)) {
				$this->Session->setFlash(__('The student has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The student could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Student->read(null, $id);
		}
		$yearLevels = $this->Student->YearLevel->find('list');
		$sections = $this->Student->Section->find('list');
		$this->set(compact('yearLevels', 'sections'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for student', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Student->delete($id)) {
			$this->Session->setFlash(__('Student deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Student was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
