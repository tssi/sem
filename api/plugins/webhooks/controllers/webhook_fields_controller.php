<?php
class WebhookFieldsController extends WebhooksAppController {

	var $name = 'WebhookFields';
	var $uses = array('Webhooks.WebhookField','Webhooks.ChannelField');
	function index() {
		$this->WebhookField->recursive = 0;
		$this->set('webhookFields', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid webhook field', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->WebhookField->contain(array('Webhook','FieldSource.id','FieldSource.channel_id','FieldSource.field','FieldTarget.id','FieldTarget.channel_id','FieldTarget.field'));
		$this->set('webhookField', $this->WebhookField->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->WebhookField->create();
			if ($this->WebhookField->save($this->data)) {
				$this->Session->setFlash(__('The webhook field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The webhook field could not be saved. Please, try again.', true));
			}
		}
		$webhooks = $this->WebhookField->Webhook->find('list');
		$this->set(compact('webhooks'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid webhook field', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->WebhookField->save($this->data)) {
				$this->Session->setFlash(__('The webhook field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The webhook field could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->WebhookField->contain();
			$this->data = $this->WebhookField->read(null, $id);
		}
		
		$webhooks = $this->WebhookField->Webhook->find('list');
		$this->set(compact('webhooks'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for webhook field', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->WebhookField->delete($id)) {
			$this->Session->setFlash(__('Webhook field deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Webhook field was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
