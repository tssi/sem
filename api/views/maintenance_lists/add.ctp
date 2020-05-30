<div class="maintenanceLists form">
<?php echo $this->Form->create('MaintenanceList');?>
	<fieldset>
		<legend><?php __('Add Maintenance List'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('path');
		echo $this->Form->input('order');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Maintenance Lists', true), array('action' => 'index'));?></li>
	</ul>
</div>