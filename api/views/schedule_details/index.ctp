<div class="scheduleDetails index">
	<h2><?php __('Schedule Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('schedule_id');?></th>
			<th><?php echo $this->Paginator->sort('start_time');?></th>
			<th><?php echo $this->Paginator->sort('end_time');?></th>
			<th><?php echo $this->Paginator->sort('days');?></th>
			<th><?php echo $this->Paginator->sort('room_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($scheduleDetails as $scheduleDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $scheduleDetail['ScheduleDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($scheduleDetail['Schedule']['id'], array('controller' => 'schedules', 'action' => 'view', $scheduleDetail['Schedule']['id'])); ?>
		</td>
		<td><?php echo $scheduleDetail['ScheduleDetail']['start_time']; ?>&nbsp;</td>
		<td><?php echo $scheduleDetail['ScheduleDetail']['end_time']; ?>&nbsp;</td>
		<td><?php echo $scheduleDetail['ScheduleDetail']['days']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($scheduleDetail['Room']['name'], array('controller' => 'rooms', 'action' => 'view', $scheduleDetail['Room']['id'])); ?>
		</td>
		<td><?php echo $scheduleDetail['ScheduleDetail']['created']; ?>&nbsp;</td>
		<td><?php echo $scheduleDetail['ScheduleDetail']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $scheduleDetail['ScheduleDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $scheduleDetail['ScheduleDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $scheduleDetail['ScheduleDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $scheduleDetail['ScheduleDetail']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Schedule Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Schedules', true), array('controller' => 'schedules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Schedule', true), array('controller' => 'schedules', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rooms', true), array('controller' => 'rooms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room', true), array('controller' => 'rooms', 'action' => 'add')); ?> </li>
	</ul>
</div>