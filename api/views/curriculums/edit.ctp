<div class="curriculums form">
<?php echo $this->Form->create('Curriculum');?>
	<fieldset>
		<legend><?php __('Edit Curriculum'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('department_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('type');
		echo $this->Form->input('alias');
		echo $this->Form->input('esp');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Curriculum.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Curriculum.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Curriculums', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Curriculum Details', true), array('controller' => 'curriculum_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Curriculum Detail', true), array('controller' => 'curriculum_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Curriculum Sections', true), array('controller' => 'curriculum_sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Curriculum Section', true), array('controller' => 'curriculum_sections', 'action' => 'add')); ?> </li>
	</ul>
</div>