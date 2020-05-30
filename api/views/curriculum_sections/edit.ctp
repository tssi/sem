<div class="curriculumSections form">
<?php echo $this->Form->create('CurriculumSection');?>
	<fieldset>
		<legend><?php __('Edit Curriculum Section'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('CurriculumSection.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('CurriculumSection.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Curriculum Sections', true), array('action' => 'index'));?></li>
	</ul>
</div>