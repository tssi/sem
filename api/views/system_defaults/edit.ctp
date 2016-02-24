<div class="systemDefaults form">
<?php echo $this->Form->create('SystemDefault');?>
	<fieldset>
		<legend><?php __('Edit System Default'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('key');
		echo $this->Form->input('value');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SystemDefault.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SystemDefault.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List System Defaults', true), array('action' => 'index'));?></li>
	</ul>
</div>