<div class="tuitions form">
<?php echo $this->Form->create('Tuition');?>
	<fieldset>
		<legend><?php __('Edit Tuition'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('sy');
		echo $this->Form->input('year_level_id');
		echo $this->Form->input('program');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Tuition.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Tuition.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tuitions', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Year Levels', true), array('controller' => 'year_levels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Year Level', true), array('controller' => 'year_levels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fee Breakdowns', true), array('controller' => 'fee_breakdowns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fee Breakdown', true), array('controller' => 'fee_breakdowns', 'action' => 'add')); ?> </li>
	</ul>
</div>