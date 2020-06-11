<div class="paymentDueDates form">
<?php echo $this->Form->create('PaymentDueDate');?>
	<fieldset>
		<legend><?php __('Add Payment Due Date'); ?></legend>
	<?php
		echo $this->Form->input('scheme_id');
		echo $this->Form->input('due_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Payment Due Dates', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Schemes', true), array('controller' => 'schemes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Scheme', true), array('controller' => 'schemes', 'action' => 'add')); ?> </li>
	</ul>
</div>