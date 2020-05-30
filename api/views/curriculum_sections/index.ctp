<div class="curriculumSections index">
	<h2><?php __('Curriculum Sections');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('section_id');?></th>
			<th><?php echo $this->Paginator->sort('curriculum_id');?></th>
			<th><?php echo $this->Paginator->sort('esp');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($curriculumSections as $curriculumSection):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $curriculumSection['CurriculumSection']['id']; ?>&nbsp;</td>
		<td><?php echo $curriculumSection['CurriculumSection']['section_id']; ?>&nbsp;</td>
		<td><?php echo $curriculumSection['CurriculumSection']['curriculum_id']; ?>&nbsp;</td>
		<td><?php echo $curriculumSection['CurriculumSection']['esp']; ?>&nbsp;</td>
		<td><?php echo $curriculumSection['CurriculumSection']['created']; ?>&nbsp;</td>
		<td><?php echo $curriculumSection['CurriculumSection']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $curriculumSection['CurriculumSection']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $curriculumSection['CurriculumSection']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $curriculumSection['CurriculumSection']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $curriculumSection['CurriculumSection']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Curriculum Section', true), array('action' => 'add')); ?></li>
	</ul>
</div>