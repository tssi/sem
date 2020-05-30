<div class="students form">
<?php echo $this->Form->create('Student');?>
	<fieldset>
		<legend><?php __('Edit Student'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('sno');
		echo $this->Form->input('lrn');
		echo $this->Form->input('year_level_id');
		echo $this->Form->input('section_id');
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('prefix');
		echo $this->Form->input('suffix');
		echo $this->Form->input('gender');
		echo $this->Form->input('birthday');
		echo $this->Form->input('nationality');
		echo $this->Form->input('religion');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Student.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Student.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Students', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Year Levels', true), array('controller' => 'year_levels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Year Level', true), array('controller' => 'year_levels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sections', true), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section', true), array('controller' => 'sections', 'action' => 'add')); ?> </li>
	</ul>
</div>