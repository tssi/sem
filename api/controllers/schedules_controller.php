<?php
class SchedulesController extends AppController {

	var $name = 'Schedules';
	var $uses = array('Schedule','Section','ScheduleDetail','Subject','Room');

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
				$subjects = array();
				foreach($details as $s=>$d){
					$sub = $d['subject_id'];
					$ss = $this->Subject->find('all',array('recursive'=>0,'conditions'=>array('Subject.id'=>$d['subject_id'])));
					$room = $this->Room->find('all',array('recursive'=>0,'conditions'=>array('Room.id'=>$d['room_id'])));
					$subject['subject'] = $ss[0]['Subject']['alias'];
					$subject['units'] = $ss[0]['Subject']['units'];
					$details[$s]['subject'] = $ss[0]['Subject']['alias'];
					
					if(!isset($subjects[$sub])){
						$subjects[$sub] = array();
						$subjects[$sub]['days'] = '';
						$subjects[$sub]['times'] = '';
						$subjects[$sub]['rooms'] = '';
					}
					$subjects[$sub]['days'] .= $d['day'].' ';
					if($subjects[$sub]['rooms']!= $room[0]['Room']['name'].' ')
					$subjects[$sub]['rooms'] .= $room[0]['Room']['name'].' ';
					if($subjects[$sub]['times']!==$d['start_time'].' - '.$d['end_time'])
						$subjects[$sub]['times'] .= $d['start_time'].' - '.$d['end_time'];
					else
						$subjects[$sub]['times'] =  $d['start_time'].' - '.$d['end_time'];
					
					//$subjects[$sub]['times'] =  $d['start_time'].' - '.$d['end_time'];
					$subjects[$sub]['subject'] = $ss[0]['Subject']['name'];
					$subjects[$sub]['subject_id'] = $sub;
					$subjects[$sub]['units'] = $ss[0]['Subject']['units'];
				}
				/* pr($subjects); exit();
				foreach($details as $s=>$d){
					$subject = array();
					$subject['subject_id'] = $d['subject_id'];
					$subject['start_time'] = $d['start_time'];
					$subject['end_time'] = $d['end_time'];
					$subject['room_id'] = $d['room_id'];
					$sub = $this->Subject->find('all',array('recursive'=>0,'conditions'=>array('Subject.id'=>$d['subject_id'])));
					$subject['subject'] = $sub[0]['Subject']['alias'];
					$subject['units'] = $sub[0]['Subject']['units'];
					$details[$s]['subject'] = $sub[0]['Subject']['alias'];
					$subject['day'] = $d['day'];
					if(!in_array($subject,$subjects)){
						array_push($subjects,$subject);
					}
				}
				pr($subjects); 
				foreach($subjects as $s=>$sub){
					$days = array();
					foreach($details as $x=>$d){
						$cond = array(
							'subject_id'=>$d['subject_id'],
							'start_time'=>$d['start_time'],
							'end_time'=>$d['end_time'],
							'room_id'=>$d['room_id'],
							'subject'=>$d['subject'],
						);
						if($cond==$sub){
							array_push($days,$d['day']);
						}
						$subjects[$s]['day'] = implode(' ',$days);
						
					}
					
				}*/
				$schedule_details = array();
				$num=0;
				foreach($subjects as $s=>$sub){
					/* $sub['times'] = date("g:i a", strtotime($sub['times']));
					$sub['times'] = date("g:i a", strtotime($sub['times'])); */
					$schedule_details[$num] = $sub;
					$num++;
				} 
				$sched['Schedule']['schedule_details'] = $schedule_details;
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
