<div class="citizenships form">
<?php echo $this->Form->create('Citizenship');?>
	<fieldset>
		<legend><?php __('Add Citizenship'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Citizenships', true), array('action' => 'index'));?></li>
	</ul>
</div>