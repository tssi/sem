<div class="paymentSchemes view">
<h2><?php  __('Payment Scheme');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $paymentScheme['PaymentScheme']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tuition'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($paymentScheme['Tuition']['name'], array('controller' => 'tuitions', 'action' => 'view', $paymentScheme['Tuition']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Scheme'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($paymentScheme['Scheme']['name'], array('controller' => 'schemes', 'action' => 'view', $paymentScheme['Scheme']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $paymentScheme['PaymentScheme']['amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Interest Charge'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $paymentScheme['PaymentScheme']['interest_charge']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Payment Scheme', true), array('action' => 'edit', $paymentScheme['PaymentScheme']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Payment Scheme', true), array('action' => 'delete', $paymentScheme['PaymentScheme']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $paymentScheme['PaymentScheme']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Schemes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Scheme', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tuitions', true), array('controller' => 'tuitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tuition', true), array('controller' => 'tuitions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schemes', true), array('controller' => 'schemes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Scheme', true), array('controller' => 'schemes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Scheme Schedules', true), array('controller' => 'payment_scheme_schedules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Scheme Schedule', true), array('controller' => 'payment_scheme_schedules', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Payment Scheme Schedules');?></h3>
	<?php if (!empty($paymentScheme['PaymentSchemeSchedule'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Payment Scheme Id'); ?></th>
		<th><?php __('Billing Period Id'); ?></th>
		<th><?php __('Amount'); ?></th>
		<th><?php __('Due Dates'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($paymentScheme['PaymentSchemeSchedule'] as $paymentSchemeSchedule):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $paymentSchemeSchedule['id'];?></td>
			<td><?php echo $paymentSchemeSchedule['payment_scheme_id'];?></td>
			<td><?php echo $paymentSchemeSchedule['billing_period_id'];?></td>
			<td><?php echo $paymentSchemeSchedule['amount'];?></td>
			<td><?php echo $paymentSchemeSchedule['due_dates'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'payment_scheme_schedules', 'action' => 'view', $paymentSchemeSchedule['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'payment_scheme_schedules', 'action' => 'edit', $paymentSchemeSchedule['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'payment_scheme_schedules', 'action' => 'delete', $paymentSchemeSchedule['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $paymentSchemeSchedule['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Payment Scheme Schedule', true), array('controller' => 'payment_scheme_schedules', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
