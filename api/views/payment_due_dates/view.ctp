<div class="paymentDueDates view">
<h2><?php  __('Payment Due Date');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $paymentDueDate['PaymentDueDate']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Scheme'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($paymentDueDate['Scheme']['name'], array('controller' => 'schemes', 'action' => 'view', $paymentDueDate['Scheme']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Due Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $paymentDueDate['PaymentDueDate']['due_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $paymentDueDate['PaymentDueDate']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $paymentDueDate['PaymentDueDate']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Payment Due Date', true), array('action' => 'edit', $paymentDueDate['PaymentDueDate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Payment Due Date', true), array('action' => 'delete', $paymentDueDate['PaymentDueDate']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $paymentDueDate['PaymentDueDate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Due Dates', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Due Date', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schemes', true), array('controller' => 'schemes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Scheme', true), array('controller' => 'schemes', 'action' => 'add')); ?> </li>
	</ul>
</div>
