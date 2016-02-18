<div class="feeBreakdowns view">
<h2><?php  __('Fee Breakdown');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $feeBreakdown['FeeBreakdown']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tuition'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($feeBreakdown['Tuition']['name'], array('controller' => 'tuitions', 'action' => 'view', $feeBreakdown['Tuition']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fee'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($feeBreakdown['Fee']['name'], array('controller' => 'fees', 'action' => 'view', $feeBreakdown['Fee']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $feeBreakdown['FeeBreakdown']['amount']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fee Breakdown', true), array('action' => 'edit', $feeBreakdown['FeeBreakdown']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fee Breakdown', true), array('action' => 'delete', $feeBreakdown['FeeBreakdown']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $feeBreakdown['FeeBreakdown']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fee Breakdowns', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fee Breakdown', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tuitions', true), array('controller' => 'tuitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tuition', true), array('controller' => 'tuitions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fees', true), array('controller' => 'fees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fee', true), array('controller' => 'fees', 'action' => 'add')); ?> </li>
	</ul>
</div>
