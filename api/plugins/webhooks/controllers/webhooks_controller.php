<?php
class WebhooksController extends WebhooksAppController {

	var $name = 'Webhooks';
	var $uses = array('Webhooks.Webhook','Webhooks.Channel');
	function index() {
		$this->Webhook->recursive = 0;
		$this->paginate['Webhook'] = array('contain'=>(array('EventSource','EventTarget')));
		$this->set('webhooks', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid webhook', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('webhook', $this->Webhook->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Webhook->create();
			if ($this->Webhook->save($this->data)) {
				$this->Session->setFlash(__('The webhook has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The webhook could not be saved. Please, try again.', true));
			}
		}
		$events = $this->Channel->ChannelEvent->find('list');
		$this->set(compact('events'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid webhook', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Webhook->save($this->data)) {
				$this->Session->setFlash(__('The webhook has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The webhook could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Webhook->read(null, $id);
		}
		$events = $this->Channel->ChannelEvent->find('list');
		$this->set(compact('events'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for webhook', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Webhook->delete($id)) {
			$this->Session->setFlash(__('Webhook deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Webhook was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
