<?php
class ChannelsController extends WebhooksAppController {

	var $name = 'Channels';

	function index() {
		$this->Channel->recursive = 0;
		$this->set('channels', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid channel', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('channel', $this->Channel->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Channel->create();
			if ($this->Channel->saveAll($this->data)) {
				$this->Session->setFlash(__('The channel has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The channel could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid channel', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Channel->save($this->data)) {
				$this->Session->setFlash(__('The channel has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The channel could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Channel->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for channel', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Channel->delete($id)) {
			$this->Session->setFlash(__('Channel deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Channel was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
