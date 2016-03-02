<?php
class ChannelEventsController extends WebhooksAppController {

	var $name = 'ChannelEvents';

	function index() {
		$this->ChannelEvent->recursive = 0;
		$this->set('channelEvents', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid channel event', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('channelEvent', $this->ChannelEvent->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ChannelEvent->create();
			if ($this->ChannelEvent->save($this->data)) {
				$this->Session->setFlash(__('The channel event has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The channel event could not be saved. Please, try again.', true));
			}
		}
		$channels = $this->ChannelEvent->Channel->find('list');
		$this->set(compact('channels'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid channel event', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ChannelEvent->save($this->data)) {
				$this->Session->setFlash(__('The channel event has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The channel event could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ChannelEvent->read(null, $id);
		}
		$channels = $this->ChannelEvent->Channel->find('list');
		$this->set(compact('channels'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for channel event', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ChannelEvent->delete($id)) {
			$this->Session->setFlash(__('Channel event deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Channel event was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
