<div class="assessments index">
	<h2><?php __('Assessments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('student_id');?></th>
			<th><?php echo $this->Paginator->sort('sy');?></th>
			<th><?php echo $this->Paginator->sort('section_id');?></th>
			<th><?php echo $this->Paginator->sort('tuition_id');?></th>
			<th><?php echo $this->Paginator->sort('scheme_id');?></th>
			<th><?php echo $this->Paginator->sort('gross_amount');?></th>
			<th><?php echo $this->Paginator->sort('charge_amount');?></th>
			<th><?php echo $this->Paginator->sort('discount_amount');?></th>
			<th><?php echo $this->Paginator->sort('paid_amount');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($assessments as $assessment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $assessment['Assessment']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($assessment['Student']['id'], array('controller' => 'students', 'action' => 'view', $assessment['Student']['id'])); ?>
		</td>
		<td><?php echo $assessment['Assessment']['sy']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($assessment['Section']['name'], array('controller' => 'sections', 'action' => 'view', $assessment['Section']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($assessment['Tuition']['name'], array('controller' => 'tuitions', 'action' => 'view', $assessment['Tuition']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($assessment['Scheme']['name'], array('controller' => 'schemes', 'action' => 'view', $assessment['Scheme']['id'])); ?>
		</td>
		<td><?php echo $assessment['Assessment']['gross_amount']; ?>&nbsp;</td>
		<td><?php echo $assessment['Assessment']['charge_amount']; ?>&nbsp;</td>
		<td><?php echo $assessment['Assessment']['discount_amount']; ?>&nbsp;</td>
		<td><?php echo $assessment['Assessment']['paid_amount']; ?>&nbsp;</td>
		<td><?php echo $assessment['Assessment']['created']; ?>&nbsp;</td>
		<td><?php echo $assessment['Assessment']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $assessment['Assessment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $assessment['Assessment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $assessment['Assessment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $assessment['Assessment']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Assessment', true), array('action' => 'add')); ?></li>
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