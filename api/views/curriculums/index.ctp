<div class="curriculums index">
	<h2><?php __('Curriculums');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('alias');?></th>
			<th><?php echo $this->Paginator->sort('esp');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($curriculums as $curriculum):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $curriculum['Curriculum']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($curriculum['Department']['name'], array('controller' => 'departments', 'action' => 'view', $curriculum['Department']['id'])); ?>
		</td>
		<td><?php echo $curriculum['Curriculum']['name']; ?>&nbsp;</td>
		<td><?php echo $curriculum['Curriculum']['description']; ?>&nbsp;</td>
		<td><?php echo $curriculum['Curriculum']['type']; ?>&nbsp;</td>
		<td><?php echo $curriculum['Curriculum']['alias']; ?>&nbsp;</td>
		<td><?php echo $curriculum['Curriculum']['esp']; ?>&nbsp;</td>
		<td><?php echo $curriculum['Curriculum']['created']; ?>&nbsp;</td>
		<td><?php echo $curriculum['Curriculum']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $curriculum['Curriculum']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $curriculum['Curriculum']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $curriculum['Curriculum']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $curriculum['Curriculum']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Curriculum', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Curriculum Details', true), array('controller' => 'curriculum_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Curriculum Detail', true), array('controller' => 'curriculum_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Curriculum Sections', true), array('controller' => 'curriculum_sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Curriculum Section', true), array('controller' => 'curriculum_sections', 'action' => 'add')); ?> </li>
	</ul>
</div>