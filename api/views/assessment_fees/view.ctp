<div class="assessmentFees view">
<h2><?php  __('Assessment Fee');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentFee['AssessmentFee']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Assessment'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($assessmentFee['Assessment']['id'], array('controller' => 'assessments', 'action' => 'view', $assessmentFee['Assessment']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fee'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($assessmentFee['Fee']['name'], array('controller' => 'fees', 'action' => 'view', $assessmentFee['Fee']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Due Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentFee['AssessmentFee']['due_amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paid Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentFee['AssessmentFee']['paid_amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentFee['AssessmentFee']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentFee['AssessmentFee']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Assessment Fee', true), array('action' => 'edit', $assessmentFee['AssessmentFee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Assessment Fee', true), array('action' => 'delete', $assessmentFee['AssessmentFee']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $assessmentFee['AssessmentFee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Assessment Fees', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment Fee', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assessments', true), array('controller' => 'assessments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment', true), array('controller' => 'assessments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fees', true), array('controller' => 'fees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fee', true), array('controller' => 'fees', 'action' => 'add')); ?> </li>
	</ul>
</div>
