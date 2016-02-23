<div class="assessments view">
<h2><?php  __('Assessment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessment['Assessment']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Student'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($assessment['Student']['id'], array('controller' => 'students', 'action' => 'view', $assessment['Student']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sy'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessment['Assessment']['sy']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Section'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($assessment['Section']['name'], array('controller' => 'sections', 'action' => 'view', $assessment['Section']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tuition'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($assessment['Tuition']['name'], array('controller' => 'tuitions', 'action' => 'view', $assessment['Tuition']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Scheme'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($assessment['Scheme']['name'], array('controller' => 'schemes', 'action' => 'view', $assessment['Scheme']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Gross Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessment['Assessment']['gross_amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Charge Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessment['Assessment']['charge_amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Discount Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessment['Assessment']['discount_amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paid Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessment['Assessment']['paid_amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessment['Assessment']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assessment['Assessment']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Assessment', true), array('action' => 'edit', $assessment['Assessment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Assessment', true), array('action' => 'delete', $assessment['Assessment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $assessment['Assessment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Assessments', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment', true), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php __('Related Assessment Adjustments');?></h3>
	<?php if (!empty($assessment['AssessmentAdjustment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Assessment Id'); ?></th>
		<th><?php __('Item Code'); ?></th>
		<th><?php __('Flag'); ?></th>
		<th><?php __('Amount'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($assessment['AssessmentAdjustment'] as $assessmentAdjustment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $assessmentAdjustment['id'];?></td>
			<td><?php echo $assessmentAdjustment['assessment_id'];?></td>
			<td><?php echo $assessmentAdjustment['item_code'];?></td>
			<td><?php echo $assessmentAdjustment['flag'];?></td>
			<td><?php echo $assessmentAdjustment['amount'];?></td>
			<td><?php echo $assessmentAdjustment['created'];?></td>
			<td><?php echo $assessmentAdjustment['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'assessment_adjustments', 'action' => 'view', $assessmentAdjustment['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'assessment_adjustments', 'action' => 'edit', $assessmentAdjustment['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'assessment_adjustments', 'action' => 'delete', $assessmentAdjustment['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $assessmentAdjustment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Assessment Adjustment', true), array('controller' => 'assessment_adjustments', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Assessment Fees');?></h3>
	<?php if (!empty($assessment['AssessmentFee'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Assessment Id'); ?></th>
		<th><?php __('Fee Id'); ?></th>
		<th><?php __('Due Amount'); ?></th>
		<th><?php __('Paid Amount'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($assessment['AssessmentFee'] as $assessmentFee):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $assessmentFee['id'];?></td>
			<td><?php echo $assessmentFee['assessment_id'];?></td>
			<td><?php echo $assessmentFee['fee_id'];?></td>
			<td><?php echo $assessmentFee['due_amount'];?></td>
			<td><?php echo $assessmentFee['paid_amount'];?></td>
			<td><?php echo $assessmentFee['created'];?></td>
			<td><?php echo $assessmentFee['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'assessment_fees', 'action' => 'view', $assessmentFee['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'assessment_fees', 'action' => 'edit', $assessmentFee['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'assessment_fees', 'action' => 'delete', $assessmentFee['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $assessmentFee['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Assessment Fee', true), array('controller' => 'assessment_fees', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Assessment Schedules');?></h3>
	<?php if (!empty($assessment['AssessmentSchedule'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Assessment Id'); ?></th>
		<th><?php __('Bill Month'); ?></th>
		<th><?php __('Due Date'); ?></th>
		<th><?php __('Due Amount'); ?></th>
		<th><?php __('Paid Amount'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($assessment['AssessmentSchedule'] as $assessmentSchedule):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $assessmentSchedule['id'];?></td>
			<td><?php echo $assessmentSchedule['assessment_id'];?></td>
			<td><?php echo $assessmentSchedule['bill_month'];?></td>
			<td><?php echo $assessmentSchedule['due_date'];?></td>
			<td><?php echo $assessmentSchedule['due_amount'];?></td>
			<td><?php echo $assessmentSchedule['paid_amount'];?></td>
			<td><?php echo $assessmentSchedule['created'];?></td>
			<td><?php echo $assessmentSchedule['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'assessment_schedules', 'action' => 'view', $assessmentSchedule['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'assessment_schedules', 'action' => 'edit', $assessmentSchedule['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'assessment_schedules', 'action' => 'delete', $assessmentSchedule['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $assessmentSchedule['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Assessment Schedule', true), array('controller' => 'assessment_schedules', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
