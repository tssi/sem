<div class="channelEvents view">
<h2><?php  __('Channel Event');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $channelEvent['ChannelEvent']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Channel'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($channelEvent['Channel']['name'], array('controller' => 'channels', 'action' => 'view', $channelEvent['Channel']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Action'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $channelEvent['ChannelEvent']['action']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Method'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $channelEvent['ChannelEvent']['method']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $channelEvent['ChannelEvent']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $channelEvent['ChannelEvent']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Channel Event', true), array('action' => 'edit', $channelEvent['ChannelEvent']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Channel Event', true), array('action' => 'delete', $channelEvent['ChannelEvent']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $channelEvent['ChannelEvent']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Channel Events', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel Event', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Channels', true), array('controller' => 'channels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel', true), array('controller' => 'channels', 'action' => 'add')); ?> </li>
	</ul>
</div>
