<?php
class ScheduleDetailsController extends AppController {

	var $name = 'ScheduleDetails';
	var $uses = array('ScheduleDetail','Schedule','Section','Program','Subject','Room');

	function index() {
		$this->ScheduleDetail->recursive = 0;
		$details = $this->paginate();
		//pr($details); exit();
		if($this->isAPIRequest()){
			$subjects = array();
			foreach($details as $i=>$detail){
				$sub = $detail['ScheduleDetail']['subject_id'];
				$dt = $detail['ScheduleDetail'];
				$room = $this->Room->find('all',array('recursive'=>0,'conditions'=>array('Room.id'=>$dt['room_id'])));
				$ss = $this->Subject->find('all',array('recursive'=>0,'conditions'=>array('Subject.id'=>$dt['subject_id'])));

				if(!isset($subjects[$sub])){
					$subjects[$sub] = array();
					$subjects[$sub]['days'] = array();
					$subjects[$sub]['times'] = array();
					$subjects[$sub]['rooms'] = array();
				}
			
				if(!in_array($dt['start_time'].' - '.$dt['end_time'],$subjects[$sub]['times']))
					array_push($subjects[$sub]['times'],$dt['start_time'].' - '.$dt['end_time']);
				if(!in_array($room[0]['Room']['name'],$subjects[$sub]['rooms']))
					array_push($subjects[$sub]['rooms'],$room[0]['Room']['name']);
				if(!in_array($dt['day'],$subjects[$sub]['days']))
					array_push($subjects[$sub]['days'],$dt['day']);
				if($subjects[$sub]['rooms']!= $room[0]['Room']['name'].' ')
				$subjects[$sub]['subject'] = $ss[0]['Subject']['alias'];
				$subjects[$sub]['units'] = $ss[0]['Subject']['units'];
			}
			pr($subjects); exit();
			$index = 0;
			$details = array();
			foreach($subjects as $i=>$sub){
				$details[$index]['ScheduleDetail'] = $sub;
				$index++;
			}
			
		}
		$this->set('scheduleDetails', $details);
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
