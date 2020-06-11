<?php
class ScheduleDetailsController extends AppController {

	var $name = 'ScheduleDetails';
	var $uses = array('ScheduleDetail','Schedule','Section','Program','Subject');

	function index() {
		$this->ScheduleDetail->recursive = 0;
		$details = $this->paginate();
		//pr($details); exit();
		if($this->isAPIRequest()){
			$check1 =array();
			foreach($details as $i=>$detail){
				$dt = array();
				$d = $detail['ScheduleDetail'];
				$sched = $detail['Schedule'];
				$room = $detail['Room'];
				$sec_id = $sched['section_id'];
				$sec = $this->Section->find('all',array('recursive'=>0,'conditions'=>array('Section.id'=>$sec_id)));
				$sub = $this->Subject->find('all',array('recursive'=>0,'conditions'=>array('Subject.id'=>$d['subject_id'])));
				$dt['subject_id'] = $d['subject_id'];
				//$dt['day'] = $d['day'];
				$dt['start_time'] = date("g:i a", strtotime($d['start_time']));
				$dt['end_time'] = date("g:i a", strtotime($d['end_time']));
				$dt['room_id'] = $room['id'];
				$dt['room'] = $room['name'];
				$dt['section_id'] = $sec_id;
				$dt['section'] = $sec[0]['Section']['name'];
				$dt['subject'] = $sub[0]['Subject']['alias'];
				$dt['units'] = $sub[0]['Subject']['units'];
				array_push($check1,$dt);
				$dt['day'] = $d['day'];
				$details[$i] = $dt;
			}
			/* pr($details); 
			pr($check1); 
			exit(); */
			$check = array();
			foreach($check1 as $i=>$detail){
				if(!in_array($detail,$check)){
					array_push($check,$detail);
				}
			}
			foreach($check as $c=>$ch){
				$days = array();
				//pr($ch); //exit();
				foreach($details as $x=>$d){
					//pr($d); exit();	
					$cond = array(
						'subject_id'=>$d['subject_id'],
						'start_time'=>$d['start_time'],
						'end_time'=>$d['end_time'],
						'room_id'=>$d['room_id'],
						'room'=>$d['room'],
						'subject'=>$d['subject'],
						'section_id'=>$d['section_id'],
						'section'=>$d['section'],
						'units'=>$d['units'],
					);
					if($cond==$ch){
						array_push($days,$d['day']);
					}
					$check[$c]['day'] = implode(' ',$days);
				}
			}
			foreach($check as $i=>$c){
				$check[$i] = '';
				$check[$i]['ScheduleDetail'] = $c;
			}
			//pr($check); exit();
		}
		$this->set('scheduleDetails', $check);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid schedule detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('scheduleDetail', $this->ScheduleDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ScheduleDetail->create();
			if ($this->ScheduleDetail->save($this->data)) {
				$this->Session->setFlash(__('The schedule detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The schedule detail could not be saved. Please, try again.', true));
			}
		}
		$schedules = $this->ScheduleDetail->Schedule->find('list');
		$rooms = $this->ScheduleDetail->Room->find('list');
		$this->set(compact('schedules', 'rooms'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid schedule detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ScheduleDetail->save($this->data)) {
				$this->Session->setFlash(__('The schedule detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The schedule detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ScheduleDetail->read(null, $id);
		}
		$schedules = $this->ScheduleDetail->Schedule->find('list');
		$rooms = $this->ScheduleDetail->Room->find('list');
		$this->set(compact('schedules', 'rooms'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for schedule detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ScheduleDetail->delete($id)) {
			$this->Session->setFlash(__('Schedule detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Schedule detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
