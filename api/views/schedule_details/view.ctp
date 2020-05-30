<div class="scheduleDetails view">
<h2><?php  __('Schedule Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scheduleDetail['ScheduleDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Schedule'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($scheduleDetail['Schedule']['id'], array('controller' => 'schedules', 'action' => 'view', $scheduleDetail['Schedule']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Start Time'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scheduleDetail['ScheduleDetail']['start_time']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('End Time'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scheduleDetail['ScheduleDetail']['end_time']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Days'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scheduleDetail['ScheduleDetail']['days']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Room'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($scheduleDetail['Room']['name'], array('controller' => 'rooms', 'action' => 'view', $scheduleDetail['Room']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scheduleDetail['ScheduleDetail']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scheduleDetail['ScheduleDetail']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Schedule Detail', true), array('action' => 'edit', $scheduleDetail['ScheduleDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Schedule Detail', true), array('action' => 'delete', $scheduleDetail['ScheduleDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $scheduleDetail['ScheduleDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Schedule Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Schedule Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schedules', true), array('controller' => 'schedules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Schedule', true), array('controller' => 'schedules', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rooms', true), array('controller' => 'rooms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room', true), array('controller' => 'rooms', 'action' => 'add')); ?> </li>
	</ul>
</div>
