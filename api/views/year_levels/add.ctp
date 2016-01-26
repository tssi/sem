<div class="yearLevels form">
<?php echo $this->Form->create('YearLevel');?>
	<fieldset>
		<legend><?php __('Add Year Level'); ?></legend>
	<?php
		echo $this->Form->input('educ_level_id');
		echo $this->Form->input('name');
		echo $this->Form->input('alias');
		echo $this->Form->input('order');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Year Levels', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Educ Levels', true), array('controller' => 'educ_levels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Educ Level', true), array('controller' => 'educ_levels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Students', true), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student', true), array('controller' => 'students', 'action' => 'add')); ?> </li>
	</ul>
</div>