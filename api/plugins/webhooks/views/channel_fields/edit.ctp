<div class="channelFields form">
<?php echo $this->Form->create('ChannelField');?>
	<fieldset>
		<legend><?php __('Edit Channel Field'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('channel_id');
		echo $this->Form->input('field');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ChannelField.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ChannelField.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Channel Fields', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Channels', true), array('controller' => 'channels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel', true), array('controller' => 'channels', 'action' => 'add')); ?> </li>
	</ul>
</div>