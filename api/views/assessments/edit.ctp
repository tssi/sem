<div class="assessments form">
<?php echo $this->Form->create('Assessment');?>
	<fieldset>
		<legend><?php __('Edit Assessment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('student_id');
		echo $this->Form->input('sy');
		echo $this->Form->input('section_id');
		echo $this->Form->input('tuition_id');
		echo $this->Form->input('scheme_id');
		echo $this->Form->input('gross_amount');
		echo $this->Form->input('charge_amount');
		echo $this->Form->input('discount_amount');
		echo $this->Form->input('paid_amount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Assessment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Assessment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Assessments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Students', true), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student', true), array('controller' => 'students', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sections', true), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section', true), array('controller' => 'sections', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tuitions', true), array('controller' => 'tuitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tuition', true), array('controller' => 'tuitions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schemes', true), array('controller' => 'schemes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Scheme', true), array('controller' => 'schemes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assessment Adjustments', true), array('controller' => 'assessment_adjustments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment Adjustment', true), array('controller' => 'assessment_adjustments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assessment Fees', true), array('controller' => 'assessment_fees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment Fee', true), array('controller' => 'assessment_fees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assessment Schedules', true), array('controller' => 'assessment_schedules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment Schedule', true), array('controller' => 'assessment_schedules', 'action' => 'add')); ?> </li>
	</ul>
</div>