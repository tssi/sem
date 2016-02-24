<div class="tuitionDiscounts index">
	<h2><?php __('Tuition Discounts');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('tuition_id');?></th>
			<th><?php echo $this->Paginator->sort('discount_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($tuitionDiscounts as $tuitionDiscount):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $tuitionDiscount['TuitionDiscount']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($tuitionDiscount['Tuition']['name'], array('controller' => 'tuitions', 'action' => 'view', $tuitionDiscount['Tuition']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($tuitionDiscount['Discount']['name'], array('controller' => 'discounts', 'action' => 'view', $tuitionDiscount['Discount']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $tuitionDiscount['TuitionDiscount']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $tuitionDiscount['TuitionDiscount']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $tuitionDiscount['TuitionDiscount']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tuitionDiscount['TuitionDiscount']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Tuition Discount', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Tuitions', true), array('controller' => 'tuitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tuition', true), array('controller' => 'tuitions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Discounts', true), array('controller' => 'discounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Discount', true), array('controller' => 'discounts', 'action' => 'add')); ?> </li>
	</ul>
</div>