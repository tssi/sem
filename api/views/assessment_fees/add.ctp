<div class="assessmentFees form">
<?php echo $this->Form->create('AssessmentFee');?>
	<fieldset>
		<legend><?php __('Add Assessment Fee'); ?></legend>
	<?php
		echo $this->Form->input('assessment_id');
		echo $this->Form->input('fee_id');
		echo $this->Form->input('due_amount');
		echo $this->Form->input('paid_amount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Assessment Fees', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Assessments', true), array('controller' => 'assessments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment', true), array('controller' => 'assessments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fees', true), array('controller' => 'fees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fee', true), array('controller' => 'fees', 'action' => 'add')); ?> </li>
	</ul>
</div>