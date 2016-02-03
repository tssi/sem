<div class="maintenanceLists form">
<?php echo $this->Form->create('MaintenanceList');?>
	<fieldset>
		<legend><?php __('Edit Maintenance List'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('path');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('MaintenanceList.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('MaintenanceList.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Maintenance Lists', true), array('action' => 'index'));?></li>
	</ul>
</div>