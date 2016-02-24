<div class="assessmentFees index">
	<h2><?php __('Assessment Fees');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('assessment_id');?></th>
			<th><?php echo $this->Paginator->sort('fee_id');?></th>
			<th><?php echo $this->Paginator->sort('due_amount');?></th>
			<th><?php echo $this->Paginator->sort('paid_amount');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($assessmentFees as $assessmentFee):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $assessmentFee['AssessmentFee']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($assessmentFee['Assessment']['id'], array('controller' => 'assessments', 'action' => 'view', $assessmentFee['Assessment']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($assessmentFee['Fee']['name'], array('controller' => 'fees', 'action' => 'view', $assessmentFee['Fee']['id'])); ?>
		</td>
		<td><?php echo $assessmentFee['AssessmentFee']['due_amount']; ?>&nbsp;</td>
		<td><?php echo $assessmentFee['AssessmentFee']['paid_amount']; ?>&nbsp;</td>
		<td><?php echo $assessmentFee['AssessmentFee']['created']; ?>&nbsp;</td>
		<td><?php echo $assessmentFee['AssessmentFee']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $assessmentFee['AssessmentFee']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $assessmentFee['AssessmentFee']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $assessmentFee['AssessmentFee']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $assessmentFee['AssessmentFee']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Assessment Fee', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Assessments', true), array('controller' => 'assessments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assessment', true), array('controller' => 'assessments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fees', true), array('controller' => 'fees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fee', true), array('controller' => 'fees', 'action' => 'add')); ?> </li>
	</ul>
</div>