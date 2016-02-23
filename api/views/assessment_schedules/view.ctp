<div class="assessmentSchedules view">
<h2><?php  __('Assessment Schedule');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentSchedule['AssessmentSchedule']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Assessment'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($assessmentSchedule['Assessment']['id'], array('controller' => 'assessments', 'action' => 'view', $assessmentSchedule['Assessment']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bill Month'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentSchedule['AssessmentSchedule']['bill_month']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Due Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentSchedule['AssessmentSchedule']['due_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Due Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentSchedule['AssessmentSchedule']['due_amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paid Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentSchedule['AssessmentSchedule']['paid_amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentSchedule['AssessmentSchedule']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentSchedule['AssessmentSchedule']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Assessment Schedule', true), array('action' => 'edit', $assessmentSchedule['AssessmentSchedule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Assessment Schedule', true), array('action' => 'delete', $assessmentSchedule['AssessmentSchedule']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $assessmentSchedule['AssessmentSchedule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Assessment Schedules', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment Schedule', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assessments', true), array('controller' => 'assessments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment', true), array('controller' => 'assessments', 'action' => 'add')); ?> </li>
	</ul>
</div>
