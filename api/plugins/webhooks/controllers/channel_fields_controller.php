<?php
class ChannelFieldsController extends WebhooksAppController {

	var $name = 'ChannelFields';

	function index() {
		$this->ChannelField->recursive = 0;
		$this->set('channelFields', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid channel field', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('channelField', $this->ChannelField->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ChannelField->create();
			if ($this->ChannelField->save($this->data)) {
				$this->Session->setFlash(__('The channel field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The channel field could not be saved. Please, try again.', true));
			}
		}
		$channels = $this->ChannelField->Channel->find('list');
		$this->set(compact('channels'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid channel field', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ChannelField->save($this->data)) {
				$this->Session->setFlash(__('The channel field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The channel field could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ChannelField->read(null, $id);
		}
		$channels = $this->ChannelField->Channel->find('list');
		$this->set(compact('channels'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for channel field', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ChannelField->delete($id)) {
			$this->Session->setFlash(__('Channel field deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Channel field was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
