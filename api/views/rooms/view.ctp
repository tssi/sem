<div class="rooms view">
<h2><?php  __('Room');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $room['Room']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $room['Room']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $room['Room']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $room['Room']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Room', true), array('action' => 'edit', $room['Room']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Room', true), array('action' => 'delete', $room['Room']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $room['Room']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rooms', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schedule Details', true), array('controller' => 'schedule_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Schedule Detail', true), array('controller' => 'schedule_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Schedule Details');?></h3>
	<?php if (!empty($room['ScheduleDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Schedule Id'); ?></th>
		<th><?php __('Start Time'); ?></th>
		<th><?php __('End Time'); ?></th>
		<th><?php __('Days'); ?></th>
		<th><?php __('Room Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($room['ScheduleDetail'] as $scheduleDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $scheduleDetail['id'];?></td>
			<td><?php echo $scheduleDetail['schedule_id'];?></td>
			<td><?php echo $scheduleDetail['start_time'];?></td>
			<td><?php echo $scheduleDetail['end_time'];?></td>
			<td><?php echo $scheduleDetail['days'];?></td>
			<td><?php echo $scheduleDetail['room_id'];?></td>
			<td><?php echo $scheduleDetail['created'];?></td>
			<td><?php echo $scheduleDetail['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'schedule_details', 'action' => 'view', $scheduleDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'schedule_details', 'action' => 'edit', $scheduleDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'schedule_details', 'action' => 'delete', $scheduleDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $scheduleDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Schedule Detail', true), array('controller' => 'schedule_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
