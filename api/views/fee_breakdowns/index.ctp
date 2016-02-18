<div class="feeBreakdowns index">
	<h2><?php __('Fee Breakdowns');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('tuition_id');?></th>
			<th><?php echo $this->Paginator->sort('fee_id');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($feeBreakdowns as $feeBreakdown):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $feeBreakdown['FeeBreakdown']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($feeBreakdown['Tuition']['name'], array('controller' => 'tuitions', 'action' => 'view', $feeBreakdown['Tuition']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($feeBreakdown['Fee']['name'], array('controller' => 'fees', 'action' => 'view', $feeBreakdown['Fee']['id'])); ?>
		</td>
		<td><?php echo $feeBreakdown['FeeBreakdown']['amount']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $feeBreakdown['FeeBreakdown']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $feeBreakdown['FeeBreakdown']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $feeBreakdown['FeeBreakdown']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $feeBreakdown['FeeBreakdown']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Fee Breakdown', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Tuitions', true), array('controller' => 'tuitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tuition', true), array('controller' => 'tuitions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fees', true), array('controller' => 'fees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fee', true), array('controller' => 'fees', 'action' => 'add')); ?> </li>
	</ul>
</div>