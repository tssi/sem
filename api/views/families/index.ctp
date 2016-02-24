<div class="families index">
	<h2><?php __('Families');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('student_id');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('occupation');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($families as $family):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $family['Family']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($family['Student']['id'], array('controller' => 'students', 'action' => 'view', $family['Student']['id'])); ?>
		</td>
		<td><?php echo $family['Family']['type']; ?>&nbsp;</td>
		<td><?php echo $family['Family']['name']; ?>&nbsp;</td>
		<td><?php echo $family['Family']['occupation']; ?>&nbsp;</td>
		<td><?php echo $family['Family']['created']; ?>&nbsp;</td>
		<td><?php echo $family['Family']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $family['Family']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $family['Family']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $family['Family']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $family['Family']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Family', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Students', true), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student', true), array('controller' => 'students', 'action' => 'add')); ?> </li>
	</ul>
</div>