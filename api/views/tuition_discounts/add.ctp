<div class="tuitionDiscounts form">
<?php echo $this->Form->create('TuitionDiscount');?>
	<fieldset>
		<legend><?php __('Add Tuition Discount'); ?></legend>
	<?php
		echo $this->Form->input('tuition_id');
		echo $this->Form->input('discount_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tuition Discounts', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Tuitions', true), array('controller' => 'tuitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tuition', true), array('controller' => 'tuitions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Discounts', true), array('controller' => 'discounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Discount', true), array('controller' => 'discounts', 'action' => 'add')); ?> </li>
	</ul>
</div>