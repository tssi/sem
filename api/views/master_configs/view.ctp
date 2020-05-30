<div class="masterConfigs view">
<h2><?php  __('Master Config');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterConfig['MasterConfig']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sys Key'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterConfig['MasterConfig']['sys_key']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sys Value'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterConfig['MasterConfig']['sys_value']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterConfig['MasterConfig']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterConfig['MasterConfig']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Master Config', true), array('action' => 'edit', $masterConfig['MasterConfig']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Master Config', true), array('action' => 'delete', $masterConfig['MasterConfig']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $masterConfig['MasterConfig']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Master Configs', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Master Config', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
