<div class="assessmentAdjustments index">
	<h2><?php __('Assessment Adjustments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('assessment_id');?></th>
			<th><?php echo $this->Paginator->sort('item_code');?></th>
			<th><?php echo $this->Paginator->sort('flag');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($assessmentAdjustments as $assessmentAdjustment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $assessmentAdjustment['AssessmentAdjustment']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($assessmentAdjustment['Assessment']['id'], array('controller' => 'assessments', 'action' => 'view', $assessmentAdjustment['Assessment']['id'])); ?>
		</td>
		<td><?php echo $assessmentAdjustment['AssessmentAdjustment']['item_code']; ?>&nbsp;</td>
		<td><?php echo $assessmentAdjustment['AssessmentAdjustment']['flag']; ?>&nbsp;</td>
		<td><?php echo $assessmentAdjustment['AssessmentAdjustment']['amount']; ?>&nbsp;</td>
		<td><?php echo $assessmentAdjustment['AssessmentAdjustment']['created']; ?>&nbsp;</td>
		<td><?php echo $assessmentAdjustment['AssessmentAdjustment']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $assessmentAdjustment['AssessmentAdjustment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $assessmentAdjustment['AssessmentAdjustment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $assessmentAdjustment['AssessmentAdjustment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $assessmentAdjustment['AssessmentAdjustment']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Assessment Adjustment', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Assessments', true), array('controller' => 'assessments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment', true), array('controller' => 'assessments', 'action' => 'add')); ?> </li>
	</ul>
</div>