<div class="citizenships view">
<h2><?php  __('Citizenship');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $citizenship['Citizenship']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $citizenship['Citizenship']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $citizenship['Citizenship']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $citizenship['Citizenship']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Citizenship', true), array('action' => 'edit', $citizenship['Citizenship']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Citizenship', true), array('action' => 'delete', $citizenship['Citizenship']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $citizenship['Citizenship']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Citizenships', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Citizenship', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
