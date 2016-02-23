<div class="assessmentAdjustments form">
<?php echo $this->Form->create('AssessmentAdjustment');?>
	<fieldset>
		<legend><?php __('Edit Assessment Adjustment'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('AssessmentAdjustment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('AssessmentAdjustment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Assessment Adjustments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Assessments', true), array('controller' => 'assessments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment', true), array('controller' => 'assessments', 'action' => 'add')); ?> </li>
	</ul>
</div>