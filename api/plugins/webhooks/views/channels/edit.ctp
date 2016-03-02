<div class="channels form">
<?php echo $this->Form->create('Channel');?>
	<fieldset>
		<legend><?php __('Edit Channel'); ?></legend>
	<?php
		echo $this->Form->input('id',array('type'=>'text'));
		echo $this->Form->input('name');
		echo $this->Form->input('base_url');
		echo $this->Form->input('endpoint');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Channel.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Channel.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Channels', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Channel Events', true), array('controller' => 'channel_events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel Event', true), array('controller' => 'channel_events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Channel Fields', true), array('controller' => 'channel_fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel Field', true), array('controller' => 'channel_fields', 'action' => 'add')); ?> </li>
	</ul>
</div>