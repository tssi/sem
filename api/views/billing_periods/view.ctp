<div class="billingPeriods view">
<h2><?php  __('Billing Period');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $billingPeriod['BillingPeriod']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $billingPeriod['BillingPeriod']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Payment Frequency'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $billingPeriod['BillingPeriod']['payment_frequency']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $billingPeriod['BillingPeriod']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $billingPeriod['BillingPeriod']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Billing Period', true), array('action' => 'edit', $billingPeriod['BillingPeriod']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Billing Period', true), array('action' => 'delete', $billingPeriod['BillingPeriod']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $billingPeriod['BillingPeriod']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Billing Periods', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Billing Period', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
