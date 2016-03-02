<div class="webhookFields form">
<?php echo $this->Form->create('WebhookField');?>
	<fieldset>
		<legend><?php __('Add Webhook Field'); ?></legend>
	<?php
		echo $this->Form->input('webhook_id');
		echo $this->Form->input('field_source');
		echo $this->Form->input('field_target');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Webhook Fields', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Webhooks', true), array('controller' => 'webhooks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Webhook', true), array('controller' => 'webhooks', 'action' => 'add')); ?> </li>
	</ul>
</div>