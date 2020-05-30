<div class="masterConfigs form">
<?php echo $this->Form->create('MasterConfig');?>
	<fieldset>
		<legend><?php __('Edit Master Config'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('sys_key');
		echo $this->Form->input('sys_value');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('MasterConfig.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('MasterConfig.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Master Configs', true), array('action' => 'index'));?></li>
	</ul>
</div>