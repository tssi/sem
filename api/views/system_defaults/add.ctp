<div class="systemDefaults form">
<?php echo $this->Form->create('SystemDefault');?>
	<fieldset>
		<legend><?php __('Add System Default'); ?></legend>
	<?php
		echo $this->Form->input('key');
		echo $this->Form->input('value');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List System Defaults', true), array('action' => 'index'));?></li>
	</ul>
</div>