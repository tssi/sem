<div class="masterModules index">
	<h2><?php __('Master Modules');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('link');?></th>
			<th><?php echo $this->Paginator->sort('is_parent');?></th>
			<th><?php echo $this->Paginator->sort('is_child');?></th>
			<th><?php echo $this->Paginator->sort('sequence');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th><?php echo $this->Paginator->sort('modified_by');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($masterModules as $masterModule):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $masterModule['MasterModule']['id']; ?>&nbsp;</td>
		<td><?php echo $masterModule['MasterModule']['name']; ?>&nbsp;</td>
		<td><?php echo $masterModule['MasterModule']['link']; ?>&nbsp;</td>
		<td><?php echo $masterModule['MasterModule']['is_parent']; ?>&nbsp;</td>
		<td><?php echo $masterModule['MasterModule']['is_child']; ?>&nbsp;</td>
		<td><?php echo $masterModule['MasterModule']['sequence']; ?>&nbsp;</td>
		<td><?php echo $masterModule['MasterModule']['created']; ?>&nbsp;</td>
		<td><?php echo $masterModule['MasterModule']['modified']; ?>&nbsp;</td>
		<td><?php echo $masterModule['MasterModule']['created_by']; ?>&nbsp;</td>
		<td><?php echo $masterModule['MasterModule']['modified_by']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $masterModule['MasterModule']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $masterModule['MasterModule']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $masterModule['MasterModule']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $masterModule['MasterModule']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Master Module', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List User Grants', true), array('controller' => 'user_grants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Grant', true), array('controller' => 'user_grants', 'action' => 'add')); ?> </li>
	</ul>
</div>