<div class="contactNumbers form">
<?php echo $this->Form->create('ContactNumber');?>
	<fieldset>
		<legend><?php __('Add Contact Number'); ?></legend>
	<?php
		echo $this->Form->input('type');
		echo $this->Form->input('number');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Contact Numbers', true), array('action' => 'index'));?></li>
	</ul>
</div>