<div class="discounts form">
<?php echo $this->Form->create('Discount');?>
	<fieldset>
		<legend><?php __('Add Discount'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('type');
		echo $this->Form->input('amount');
		echo $this->Form->input('fees_applicable');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Discounts', true), array('action' => 'index'));?></li>
	</ul>
</div>