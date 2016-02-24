<div class="paymentSchemes index">
	<h2><?php __('Payment Schemes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('tuition_id');?></th>
			<th><?php echo $this->Paginator->sort('scheme_id');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('interest_charge');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($paymentSchemes as $paymentScheme):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $paymentScheme['PaymentScheme']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($paymentScheme['Tuition']['name'], array('controller' => 'tuitions', 'action' => 'view', $paymentScheme['Tuition']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($paymentScheme['Scheme']['name'], array('controller' => 'schemes', 'action' => 'view', $paymentScheme['Scheme']['id'])); ?>
		</td>
		<td><?php echo $paymentScheme['PaymentScheme']['amount']; ?>&nbsp;</td>
		<td><?php echo $paymentScheme['PaymentScheme']['interest_charge']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $paymentScheme['PaymentScheme']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $paymentScheme['PaymentScheme']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $paymentScheme['PaymentScheme']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $paymentScheme['PaymentScheme']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Payment Scheme', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Tuitions', true), array('controller' => 'tuitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tuition', true), array('controller' => 'tuitions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schemes', true), array('controller' => 'schemes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Scheme', true), array('controller' => 'schemes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Scheme Schedules', true), array('controller' => 'payment_scheme_schedules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Scheme Schedule', true), array('controller' => 'payment_scheme_schedules', 'action' => 'add')); ?> </li>
	</ul>
</div>