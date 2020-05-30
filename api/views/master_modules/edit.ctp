<div class="masterModules form">
<?php echo $this->Form->create('MasterModule');?>
	<fieldset>
		<legend><?php __('Edit Master Module'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('link');
		echo $this->Form->input('is_parent');
		echo $this->Form->input('is_child');
		echo $this->Form->input('sequence');
		echo $this->Form->input('created_by');
		echo $this->Form->input('modified_by');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('MasterModule.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('MasterModule.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Master Modules', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List User Grants', true), array('controller' => 'user_grants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Grant', true), array('controller' => 'user_grants', 'action' => 'add')); ?> </li>
	</ul>
</div>