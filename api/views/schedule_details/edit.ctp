<div class="scheduleDetails form">
<?php echo $this->Form->create('ScheduleDetail');?>
	<fieldset>
		<legend><?php __('Edit Schedule Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('schedule_id');
		echo $this->Form->input('start_time');
		echo $this->Form->input('end_time');
		echo $this->Form->input('days');
		echo $this->Form->input('room_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ScheduleDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ScheduleDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Schedule Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Schedules', true), array('controller' => 'schedules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Schedule', true), array('controller' => 'schedules', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rooms', true), array('controller' => 'rooms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room', true), array('controller' => 'rooms', 'action' => 'add')); ?> </li>
	</ul>
</div>