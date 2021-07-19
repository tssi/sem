<?php
class EnrollmentListsController extends AppController {

	var $name = 'EnrollmentLists';

	function index() {
		$this->EnrollmentList->recursive = 0;
		$list = $this->paginate();
		$levels = array(
							'G7'=>array(),
							'G8'=>array(),
							'G9'=>array(),
							'GX'=>array(),
							'GYSTEM'=>array(),
							'GYHUMS'=>array(),
							'GYABM'=>array(),
							'GYTVL'=>array(),
							'GZSTEM'=>array(),
							'GZHUMS'=>array(),
							'GZABM'=>array(),
							'GZTVL'=>array(),
							);
		$HS = array('G7','G8','G9','GX');
		$programs = array(
			'SHSTM'=>"STEM",
			'SHHUM'=>"HUMS",
			'SHTVL'=>"TVL",
			'SHABM'=>"ABM"
		);
		if($this->isAPIRequest()){
			foreach($list as $i=>$l){
				$stud = $l['Student'];
				$data = $l['EnrollmentList'];
				if(isset($stud['full_name']))
					$data['name'] = $stud['full_name'];
				else{
					$data['name'] = $stud['first_name'].' '.$stud['last_name'];
					//pr($l); exit();
				}
				if(!isset($l['Student']['id'])){
					pr($l); exit();
				}
				$data['year_level_id'] = $stud['year_level_id'];
				$data['program_id'] = $stud['program_id'];
				if(in_array($stud['year_level_id'],$HS)){
					array_push($levels[$stud['year_level_id']],$data);
				}else{
					$program = $programs[$stud['program_id']];
					$prog_display = $stud['year_level_id'].$program;
					array_push($levels[$prog_display],$data);
				}
			}
			$ctr = 0;
			$list = array();
			foreach($levels as $i=>$level){
				//pr($level);
				$list[$ctr]['EnrollmentList'] = array('level'=>$i,'lists'=>$level);
				$ctr++;
				/* foreach($level as $l){
					$ctr++;
				} */
			}
		}
		//pr($list); exit();
		$this->set('enrollmentLists', $list);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid EnrollmentList', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('enrollmentList', $this->EnrollmentList->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->EnrollmentList->create();
			if ($this->EnrollmentList->save($this->data)) {
				$this->Session->setFlash(__('The EnrollmentList has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The EnrollmentList could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid EnrollmentList', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->EnrollmentList->save($this->data)) {
				$this->Session->setFlash(__('The EnrollmentList has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The EnrollmentList could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EnrollmentList->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for EnrollmentList', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EnrollmentList->delete($id)) {
			$this->Session->setFlash(__('EnrollmentList deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('EnrollmentList was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
