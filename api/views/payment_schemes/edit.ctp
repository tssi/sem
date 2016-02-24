<div class="paymentSchemes form">
<?php echo $this->Form->create('PaymentScheme');?>
	<fieldset>
		<legend><?php __('Edit Payment Scheme'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tuition_id');
		echo $this->Form->input('scheme_id');
		echo $this->Form->input('amount');
		echo $this->Form->input('interest_charge');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('PaymentScheme.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('PaymentScheme.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Payment Schemes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Tuitions', true), array('controller' => 'tuitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tuition', true), array('controller' => 'tuitions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schemes', true), array('controller' => 'schemes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Scheme', true), array('controller' => 'schemes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Scheme Schedules', true), array('controller' => 'payment_scheme_schedules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Scheme Schedule', true), array('controller' => 'payment_scheme_schedules', 'action' => 'add')); ?> </li>
	</ul>
</div>