<div class="assessmentAdjustments form">
<?php echo $this->Form->create('AssessmentAdjustment');?>
	<fieldset>
		<legend><?php __('Add Assessment Adjustment'); ?></legend>
	<?php
		echo $this->Form->input('assessment_id');
		echo $this->Form->input('item_code');
		echo $this->Form->input('flag');
		echo $this->Form->input('amount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Assessment Adjustments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Assessments', true), array('controller' => 'assessments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment', true), array('controller' => 'assessments', 'action' => 'add')); ?> </li>
	</ul>
</div>