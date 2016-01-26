<div class="addresses form">
<?php echo $this->Form->create('Address');?>
	<fieldset>
		<legend><?php __('Edit Address'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('type');
		echo $this->Form->input('country');
		echo $this->Form->input('province');
		echo $this->Form->input('city');
		echo $this->Form->input('barangay');
		echo $this->Form->input('address');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Address.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Address.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Addresses', true), array('action' => 'index'));?></li>
	</ul>
</div>