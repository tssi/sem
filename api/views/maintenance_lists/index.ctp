<div class="maintenanceLists index">
	<h2><?php __('Maintenance Lists');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('path');?></th>
			<th><?php echo $this->Paginator->sort('order');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($maintenanceLists as $maintenanceList):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $maintenanceList['MaintenanceList']['id']; ?>&nbsp;</td>
		<td><?php echo $maintenanceList['MaintenanceList']['name']; ?>&nbsp;</td>
		<td><?php echo $maintenanceList['MaintenanceList']['description']; ?>&nbsp;</td>
		<td><?php echo $maintenanceList['MaintenanceList']['path']; ?>&nbsp;</td>
		<td><?php echo $maintenanceList['MaintenanceList']['order']; ?>&nbsp;</td>
		<td><?php echo $maintenanceList['MaintenanceList']['created']; ?>&nbsp;</td>
		<td><?php echo $maintenanceList['MaintenanceList']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $maintenanceList['MaintenanceList']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $maintenanceList['MaintenanceList']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $maintenanceList['MaintenanceList']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $maintenanceList['MaintenanceList']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Maintenance List', true), array('action' => 'add')); ?></li>
	</ul>
</div>