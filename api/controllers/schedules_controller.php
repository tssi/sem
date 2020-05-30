<?php
class SchedulesController extends AppController {

	var $name = 'Schedules';
	var $uses = array('Schedule','Section','ScheduleDetail');

	function index() {
		$this->Schedule->recursive = 0;
		$schedules = $this->paginate();
		
		if($this->isAPIRequest()){
			foreach($schedules as $i=>$sched){
				//pr($sched); exit();
				$sched['Schedule']['id'] = $sched['Schedule']['id'];
				$sched['Schedule']['section_id'] = $sched['Schedule']['section_id'];
				$sched['Schedule']['esp'] = $sched['Schedule']['esp'];
				$details = $sched['ScheduleDetail'];
				$sec_id = $sched['Schedule']['section_id'];
				$section = $this->Section->find('all',array('recursive'=>0,'conditions'=>array('Section.id'=>$sec_id)));
				$sched['Schedule']['section'] = $section[0]['Section']['name'];
				$sched_details = array();
				foreach($details as $d=>$detail){
					array_push($sched_details,$detail);
				}
				$sched['Schedule']['schedule_details'] = $sched_details;
				$schedules[$i] = $sched;
			}
		}
		$this->set('schedules', $schedules);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid schedule', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('schedule', $this->Schedule->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Schedule->create();
			if ($this->Schedule->save($this->data)) {
				$this->Session->setFlash(__('The schedule has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The schedule could not be saved. Please, try again.', true));
			}
		}
		$sections = $this->Schedule->Section->find('list');
		$this->set(compact('sections'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid schedule', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Schedule->save($this->data)) {
				$this->Session->setFlash(__('The schedule has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The schedule could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Schedule->read(null, $id);
		}
		$sections = $this->Schedule->Section->find('list');
		$this->set(compact('sections'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for schedule', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Schedule->delete($id)) {
			$this->Session->setFlash(__('Schedule deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Schedule was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
