<?php
class ScheduleDetailsController extends AppController {

	var $name = 'ScheduleDetails';

	function index() {
		$this->ScheduleDetail->recursive = 0;
		pr($this->paginate());
		$this->set('scheduleDetails', $this->paginate());
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
