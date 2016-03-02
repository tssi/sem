<div class="channelEvents form">
<?php echo $this->Form->create('ChannelEvent');?>
	<fieldset>
		<legend><?php __('Edit Channel Event'); ?></legend>
	<?php
		echo $this->Form->input('id',array('type'=>'text'));
		echo $this->Form->input('channel_id');
		echo $this->Form->input('action');
		echo $this->Form->input('method');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ChannelEvent.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ChannelEvent.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Channel Events', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Channels', true), array('controller' => 'channels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel', true), array('controller' => 'channels', 'action' => 'add')); ?> </li>
	</ul>
</div>