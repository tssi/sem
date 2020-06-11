<div class="paymentDueDates index">
	<h2><?php __('Payment Due Dates');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('scheme_id');?></th>
			<th><?php echo $this->Paginator->sort('due_date');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($paymentDueDates as $paymentDueDate):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $paymentDueDate['PaymentDueDate']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($paymentDueDate['Scheme']['name'], array('controller' => 'schemes', 'action' => 'view', $paymentDueDate['Scheme']['id'])); ?>
		</td>
		<td><?php echo $paymentDueDate['PaymentDueDate']['due_date']; ?>&nbsp;</td>
		<td><?php echo $paymentDueDate['PaymentDueDate']['created']; ?>&nbsp;</td>
		<td><?php echo $paymentDueDate['PaymentDueDate']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $paymentDueDate['PaymentDueDate']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $paymentDueDate['PaymentDueDate']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $paymentDueDate['PaymentDueDate']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $paymentDueDate['PaymentDueDate']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Payment Due Date', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Schemes', true), array('controller' => 'schemes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Scheme', true), array('controller' => 'schemes', 'action' => 'add')); ?> </li>
	</ul>
</div>