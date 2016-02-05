<div class="schemes view">
<h2><?php  __('Scheme');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scheme['Scheme']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scheme['Scheme']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Payment Frequency'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scheme['Scheme']['payment_frequency']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scheme['Scheme']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scheme['Scheme']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Scheme', true), array('action' => 'edit', $scheme['Scheme']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Scheme', true), array('action' => 'delete', $scheme['Scheme']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $scheme['Scheme']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Schemes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Scheme', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
