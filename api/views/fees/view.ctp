<div class="fees view">
<h2><?php  __('Fee');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fee['Fee']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fee['Fee']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Order'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fee['Fee']['order']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fee['Fee']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fee['Fee']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fee', true), array('action' => 'edit', $fee['Fee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fee', true), array('action' => 'delete', $fee['Fee']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fee['Fee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fees', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fee', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
