<div class="contactNumbers view">
<h2><?php  __('Contact Number');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contactNumber['ContactNumber']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contactNumber['ContactNumber']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Number'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contactNumber['ContactNumber']['number']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contactNumber['ContactNumber']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contactNumber['ContactNumber']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contact Number', true), array('action' => 'edit', $contactNumber['ContactNumber']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Contact Number', true), array('action' => 'delete', $contactNumber['ContactNumber']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contactNumber['ContactNumber']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contact Numbers', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contact Number', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
