<div class="schemes form">
<?php echo $this->Form->create('Scheme');?>
	<fieldset>
		<legend><?php __('Add Scheme'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('payment_frequency');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Schemes', true), array('action' => 'index'));?></li>
	</ul>
</div>