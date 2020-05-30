<div class="curriculumSections view">
<h2><?php  __('Curriculum Section');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculumSection['CurriculumSection']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Section Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculumSection['CurriculumSection']['section_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Curriculum Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculumSection['CurriculumSection']['curriculum_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Esp'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculumSection['CurriculumSection']['esp']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculumSection['CurriculumSection']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculumSection['CurriculumSection']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Curriculum Section', true), array('action' => 'edit', $curriculumSection['CurriculumSection']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Curriculum Section', true), array('action' => 'delete', $curriculumSection['CurriculumSection']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $curriculumSection['CurriculumSection']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Curriculum Sections', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Curriculum Section', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
