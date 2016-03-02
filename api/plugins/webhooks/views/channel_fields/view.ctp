<div class="channelFields view">
<h2><?php  __('Channel Field');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $channelField['ChannelField']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Channel'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($channelField['Channel']['name'], array('controller' => 'channels', 'action' => 'view', $channelField['Channel']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Field'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $channelField['ChannelField']['field']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $channelField['ChannelField']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $channelField['ChannelField']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Channel Field', true), array('action' => 'edit', $channelField['ChannelField']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Channel Field', true), array('action' => 'delete', $channelField['ChannelField']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $channelField['ChannelField']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Channel Fields', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel Field', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Channels', true), array('controller' => 'channels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel', true), array('controller' => 'channels', 'action' => 'add')); ?> </li>
	</ul>
</div>
