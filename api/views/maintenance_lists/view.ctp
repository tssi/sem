<div class="maintenanceLists view">
<h2><?php  __('Maintenance List');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $maintenanceList['MaintenanceList']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $maintenanceList['MaintenanceList']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $maintenanceList['MaintenanceList']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Path'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $maintenanceList['MaintenanceList']['path']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Order'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $maintenanceList['MaintenanceList']['order']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $maintenanceList['MaintenanceList']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $maintenanceList['MaintenanceList']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Maintenance List', true), array('action' => 'edit', $maintenanceList['MaintenanceList']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Maintenance List', true), array('action' => 'delete', $maintenanceList['MaintenanceList']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $maintenanceList['MaintenanceList']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Maintenance Lists', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Maintenance List', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
