<div class="userGrants form">
<?php echo $this->Form->create('UserGrant');?>
	<fieldset>
		<legend><?php __('Edit User Grant'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_type_id');
		echo $this->Form->input('master_module_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('UserGrant.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('UserGrant.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List User Grants', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List User Types', true), array('controller' => 'user_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Type', true), array('controller' => 'user_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Master Modules', true), array('controller' => 'master_modules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Master Module', true), array('controller' => 'master_modules', 'action' => 'add')); ?> </li>
	</ul>
</div>