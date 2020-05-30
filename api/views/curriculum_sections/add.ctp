<div class="curriculumSections form">
<?php echo $this->Form->create('CurriculumSection');?>
	<fieldset>
		<legend><?php __('Add Curriculum Section'); ?></legend>
	<?php
		echo $this->Form->input('section_id');
		echo $this->Form->input('curriculum_id');
		echo $this->Form->input('esp');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Curriculum Sections', true), array('action' => 'index'));?></li>
	</ul>
</div>