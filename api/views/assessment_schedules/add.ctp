<div class="assessmentSchedules form">
<?php echo $this->Form->create('AssessmentSchedule');?>
	<fieldset>
		<legend><?php __('Add Assessment Schedule'); ?></legend>
	<?php
		echo $this->Form->input('assessment_id');
		echo $this->Form->input('bill_month');
		echo $this->Form->input('due_date');
		echo $this->Form->input('due_amount');
		echo $this->Form->input('paid_amount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Assessment Schedules', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Assessments', true), array('controller' => 'assessments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment', true), array('controller' => 'assessments', 'action' => 'add')); ?> </li>
	</ul>
</div>