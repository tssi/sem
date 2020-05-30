<div class="curriculums view">
<h2><?php  __('Curriculum');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculum['Curriculum']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($curriculum['Department']['name'], array('controller' => 'departments', 'action' => 'view', $curriculum['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculum['Curriculum']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculum['Curriculum']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculum['Curriculum']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Alias'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculum['Curriculum']['alias']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Esp'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculum['Curriculum']['esp']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculum['Curriculum']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculum['Curriculum']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Curriculum', true), array('action' => 'edit', $curriculum['Curriculum']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Curriculum', true), array('action' => 'delete', $curriculum['Curriculum']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $curriculum['Curriculum']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Curriculums', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Curriculum', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Curriculum Details', true), array('controller' => 'curriculum_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Curriculum Detail', true), array('controller' => 'curriculum_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Curriculum Sections', true), array('controller' => 'curriculum_sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Curriculum Section', true), array('controller' => 'curriculum_sections', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Curriculum Details');?></h3>
	<?php if (!empty($curriculum['CurriculumDetail'])):?>
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
		foreach ($curriculum['CurriculumDetail'] as $curriculumDetail):
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
	<h3><?php __('Related Curriculum Sections');?></h3>
	<?php if (!empty($curriculum['CurriculumSection'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Section Id'); ?></th>
		<th><?php __('Curriculum Id'); ?></th>
		<th><?php __('Esp'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($curriculum['CurriculumSection'] as $curriculumSection):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $curriculumSection['id'];?></td>
			<td><?php echo $curriculumSection['section_id'];?></td>
			<td><?php echo $curriculumSection['curriculum_id'];?></td>
			<td><?php echo $curriculumSection['esp'];?></td>
			<td><?php echo $curriculumSection['created'];?></td>
			<td><?php echo $curriculumSection['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'curriculum_sections', 'action' => 'view', $curriculumSection['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'curriculum_sections', 'action' => 'edit', $curriculumSection['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'curriculum_sections', 'action' => 'delete', $curriculumSection['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $curriculumSection['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Curriculum Section', true), array('controller' => 'curriculum_sections', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
