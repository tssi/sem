<div class="feeBreakdowns form">
<?php echo $this->Form->create('FeeBreakdown');?>
	<fieldset>
		<legend><?php __('Edit Fee Breakdown'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tuition_id');
		echo $this->Form->input('fee_id');
		echo $this->Form->input('amount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('FeeBreakdown.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('FeeBreakdown.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fee Breakdowns', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Tuitions', true), array('controller' => 'tuitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tuition', true), array('controller' => 'tuitions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fees', true), array('controller' => 'fees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fee', true), array('controller' => 'fees', 'action' => 'add')); ?> </li>
	</ul>
</div>