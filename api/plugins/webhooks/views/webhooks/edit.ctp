<div class="webhooks form">
<?php echo $this->Form->create('Webhook');?>
	<fieldset>
		<legend><?php __('Edit Webhook'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('event_source',array('options'=>$events));
		echo $this->Form->input('event_target',array('options'=>$events));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Webhook.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Webhook.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Webhooks', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Channel Events', true), array('controller' => 'channel_events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Source', true), array('controller' => 'channel_events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Webhook Fields', true), array('controller' => 'webhook_fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Webhook Field', true), array('controller' => 'webhook_fields', 'action' => 'add')); ?> </li>
	</ul>
</div>