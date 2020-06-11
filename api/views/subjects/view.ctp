<div class="subjects view">
<h2><?php  __('Subject');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($subject['Department']['name'], array('controller' => 'departments', 'action' => 'view', $subject['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Year Level'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($subject['YearLevel']['name'], array('controller' => 'year_levels', 'action' => 'view', $subject['YearLevel']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Alias'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['alias']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Units'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['units']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lec'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['lec']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lab'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['lab']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Subject', true), array('action' => 'edit', $subject['Subject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Subject', true), array('action' => 'delete', $subject['Subject']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subject['Subject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Subjects', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subject', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Year Levels', true), array('controller' => 'year_levels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Year Level', true), array('controller' => 'year_levels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Curriculum Details', true), array('controller' => 'curriculum_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Curriculum Detail', true), array('controller' => 'curriculum_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schedule Details', true), array('controller' => 'schedule_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Schedule Detail', true), array('controller' => 'schedule_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Curriculum Details');?></h3>
	<?php if (!empty($subject['CurriculumDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Curriculum Id'); ?></th>
		<th><?php __('Year Level Id'); ?></th>
		<th><?php __('Subject Id'); ?></th>
		<th><?php __('Under'); ?></th>
		<th><?php __('Weight'); ?></th>
		<th><?php __('Unit'); ?></th>
		<th><?php __('Lec Hour'); ?></th>
		<th><?php __('Lab Hour'); ?></th>
		<th><?php __('Is Parent'); ?></th>
		<th><?php __('Is Load'); ?></th>
		<th><?php __('Is Print'); ?></th>
		<th><?php __('Is Conduct'); ?></th>
		<th><?php __('Is Average'); ?></th>
		<th><?php __('Indention'); ?></th>
		<th><?php __('Print On'); ?></th>
		<th><?php __('Order'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($subject['CurriculumDetail'] as $curriculumDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $curriculumDetail['id'];?></td>
			<td><?php echo $curriculumDetail['curriculum_id'];?></td>
			<td><?php echo $curriculumDetail['year_level_id'];?></td>
			<td><?php echo $curriculumDetail['subject_id'];?></td>
			<td><?php echo $curriculumDetail['under'];?></td>
			<td><?php echo $curriculumDetail['weight'];?></td>
			<td><?php echo $curriculumDetail['unit'];?></td>
			<td><?php echo $curriculumDetail['lec_hour'];?></td>
			<td><?php echo $curriculumDetail['lab_hour'];?></td>
			<td><?php echo $curriculumDetail['is_parent'];?></td>
			<td><?php echo $curriculumDetail['is_load'];?></td>
			<td><?php echo $curriculumDetail['is_print'];?></td>
			<td><?php echo $curriculumDetail['is_conduct'];?></td>
			<td><?php echo $curriculumDetail['is_average'];?></td>
			<td><?php echo $curriculumDetail['indention'];?></td>
			<td><?php echo $curriculumDetail['print_on'];?></td>
			<td><?php echo $curriculumDetail['order'];?></td>
			<td><?php echo $curriculumDetail['created'];?></td>
			<td><?php echo $curriculumDetail['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'curriculum_details', 'action' => 'view', $curriculumDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'curriculum_details', 'action' => 'edit', $curriculumDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'curriculum_details', 'action' => 'delete', $curriculumDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $curriculumDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Curriculum Detail', true), array('controller' => 'curriculum_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Schedule Details');?></h3>
	<?php if (!empty($subject['ScheduleDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Schedule Id'); ?></th>
		<th><?php __('Subject Id'); ?></th>
		<th><?php __('Start Time'); ?></th>
		<th><?php __('End Time'); ?></th>
		<th><?php __('Day'); ?></th>
		<th><?php __('Room Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($subject['ScheduleDetail'] as $scheduleDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $scheduleDetail['id'];?></td>
			<td><?php echo $scheduleDetail['schedule_id'];?></td>
			<td><?php echo $scheduleDetail['subject_id'];?></td>
			<td><?php echo $scheduleDetail['start_time'];?></td>
			<td><?php echo $scheduleDetail['end_time'];?></td>
			<td><?php echo $scheduleDetail['day'];?></td>
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
