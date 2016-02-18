<div class="discounts form">
<?php echo $this->Form->create('Discount');?>
	<fieldset>
		<legend><?php __('Edit Discount'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Discount.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Discount.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Discounts', true), array('action' => 'index'));?></li>
	</ul>
</div>