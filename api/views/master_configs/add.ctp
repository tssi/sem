<div class="masterConfigs form">
<?php echo $this->Form->create('MasterConfig');?>
	<fieldset>
		<legend><?php __('Add Master Config'); ?></legend>
	<?php
		echo $this->Form->input('sys_key');
		echo $this->Form->input('sys_value');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Master Configs', true), array('action' => 'index'));?></li>
	</ul>
</div>