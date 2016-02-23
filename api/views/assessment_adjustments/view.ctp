<div class="assessmentAdjustments view">
<h2><?php  __('Assessment Adjustment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentAdjustment['AssessmentAdjustment']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Assessment'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($assessmentAdjustment['Assessment']['id'], array('controller' => 'assessments', 'action' => 'view', $assessmentAdjustment['Assessment']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentAdjustment['AssessmentAdjustment']['item_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Flag'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentAdjustment['AssessmentAdjustment']['flag']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentAdjustment['AssessmentAdjustment']['amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentAdjustment['AssessmentAdjustment']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessmentAdjustment['AssessmentAdjustment']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Assessment Adjustment', true), array('action' => 'edit', $assessmentAdjustment['AssessmentAdjustment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Assessment Adjustment', true), array('action' => 'delete', $assessmentAdjustment['AssessmentAdjustment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $assessmentAdjustment['AssessmentAdjustment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Assessment Adjustments', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment Adjustment', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assessments', true), array('controller' => 'assessments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment', true), array('controller' => 'assessments', 'action' => 'add')); ?> </li>
	</ul>
</div>
