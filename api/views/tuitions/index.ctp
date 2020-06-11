<div class="tuitions index">
	<h2><?php __('Tuitions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('sy');?></th>
			<th><?php echo $this->Paginator->sort('year_level_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($tuitions as $tuition):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $tuition['Tuition']['id']; ?>&nbsp;</td>
		<td><?php echo $tuition['Tuition']['name']; ?>&nbsp;</td>
		<td><?php echo $tuition['Tuition']['description']; ?>&nbsp;</td>
		<td><?php echo $tuition['Tuition']['sy']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($tuition['YearLevel']['name'], array('controller' => 'year_levels', 'action' => 'view', $tuition['YearLevel']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $tuition['Tuition']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $tuition['Tuition']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $tuition['Tuition']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tuition['Tuition']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Tuition', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Year Levels', true), array('controller' => 'year_levels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Year Level', true), array('controller' => 'year_levels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fee Breakdowns', true), array('controller' => 'fee_breakdowns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fee Breakdown', true), array('controller' => 'fee_breakdowns', 'action' => 'add')); ?> </li>
	</ul>
</div>