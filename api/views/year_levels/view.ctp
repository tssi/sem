<div class="yearLevels view">
<h2><?php  __('Year Level');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $yearLevel['YearLevel']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Educ Level'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($yearLevel['EducLevel']['name'], array('controller' => 'educ_levels', 'action' => 'view', $yearLevel['EducLevel']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $yearLevel['YearLevel']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Alias'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $yearLevel['YearLevel']['alias']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Order'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $yearLevel['YearLevel']['order']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $yearLevel['YearLevel']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $yearLevel['YearLevel']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Year Level', true), array('action' => 'edit', $yearLevel['YearLevel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Year Level', true), array('action' => 'delete', $yearLevel['YearLevel']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $yearLevel['YearLevel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Year Levels', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Year Level', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Educ Levels', true), array('controller' => 'educ_levels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Educ Level', true), array('controller' => 'educ_levels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Students', true), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student', true), array('controller' => 'students', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Students');?></h3>
	<?php if (!empty($yearLevel['Student'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Educ Level Id'); ?></th>
		<th><?php __('Year Level Id'); ?></th>
		<th><?php __('First Name'); ?></th>
		<th><?php __('Middle Name'); ?></th>
		<th><?php __('Last Name'); ?></th>
		<th><?php __('Suffix Name'); ?></th>
		<th><?php __('Gender'); ?></th>
		<th><?php __('Birthday'); ?></th>
		<th><?php __('Birthplace'); ?></th>
		<th><?php __('Religion'); ?></th>
		<th><?php __('Citizenship'); ?></th>
		<th><?php __('Prev School'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($yearLevel['Student'] as $student):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $student['id'];?></td>
			<td><?php echo $student['educ_level_id'];?></td>
			<td><?php echo $student['year_level_id'];?></td>
			<td><?php echo $student['first_name'];?></td>
			<td><?php echo $student['middle_name'];?></td>
			<td><?php echo $student['last_name'];?></td>
			<td><?php echo $student['suffix_name'];?></td>
			<td><?php echo $student['gender'];?></td>
			<td><?php echo $student['birthday'];?></td>
			<td><?php echo $student['birthplace'];?></td>
			<td><?php echo $student['religion'];?></td>
			<td><?php echo $student['citizenship'];?></td>
			<td><?php echo $student['prev_school'];?></td>
			<td><?php echo $student['created'];?></td>
			<td><?php echo $student['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'students', 'action' => 'view', $student['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'students', 'action' => 'edit', $student['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'students', 'action' => 'delete', $student['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $student['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Student', true), array('controller' => 'students', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
