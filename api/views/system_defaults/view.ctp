<div class="systemDefaults view">
<h2><?php  __('System Default');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $systemDefault['SystemDefault']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Key'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $systemDefault['SystemDefault']['key']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Value'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $systemDefault['SystemDefault']['value']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit System Default', true), array('action' => 'edit', $systemDefault['SystemDefault']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete System Default', true), array('action' => 'delete', $systemDefault['SystemDefault']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $systemDefault['SystemDefault']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List System Defaults', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New System Default', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
