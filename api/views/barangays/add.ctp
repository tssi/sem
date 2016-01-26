<div class="barangays form">
<?php echo $this->Form->create('Barangay');?>
	<fieldset>
		<legend><?php __('Add Barangay'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('city_id');
		echo $this->Form->input('is_active');
		echo $this->Form->input('zip_code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Barangays', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Cities', true), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City', true), array('controller' => 'cities', 'action' => 'add')); ?> </li>
	</ul>
</div>