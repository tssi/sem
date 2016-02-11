<div class="tuitionDiscounts view">
<h2><?php  __('Tuition Discount');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tuitionDiscount['TuitionDiscount']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tuition'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($tuitionDiscount['Tuition']['name'], array('controller' => 'tuitions', 'action' => 'view', $tuitionDiscount['Tuition']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Discount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($tuitionDiscount['Discount']['name'], array('controller' => 'discounts', 'action' => 'view', $tuitionDiscount['Discount']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tuition Discount', true), array('action' => 'edit', $tuitionDiscount['TuitionDiscount']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tuition Discount', true), array('action' => 'delete', $tuitionDiscount['TuitionDiscount']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tuitionDiscount['TuitionDiscount']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tuition Discounts', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tuition Discount', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tuitions', true), array('controller' => 'tuitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tuition', true), array('controller' => 'tuitions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Discounts', true), array('controller' => 'discounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Discount', true), array('controller' => 'discounts', 'action' => 'add')); ?> </li>
	</ul>
</div>
