<div class="channels view">
<h2><?php  __('Channel');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $channel['Channel']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $channel['Channel']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Base Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $channel['Channel']['base_url']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Endpoint'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $channel['Channel']['endpoint']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $channel['Channel']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $channel['Channel']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Channel', true), array('action' => 'edit', $channel['Channel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Channel', true), array('action' => 'delete', $channel['Channel']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $channel['Channel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Channels', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Channel Events', true), array('controller' => 'channel_events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel Event', true), array('controller' => 'channel_events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Channel Fields', true), array('controller' => 'channel_fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel Field', true), array('controller' => 'channel_fields', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Channel Events');?></h3>
	<?php if (!empty($channel['ChannelEvent'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Channel Id'); ?></th>
		<th><?php __('Action'); ?></th>
		<th><?php __('Method'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($channel['ChannelEvent'] as $channelEvent):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $channelEvent['id'];?></td>
			<td><?php echo $channelEvent['channel_id'];?></td>
			<td><?php echo $channelEvent['action'];?></td>
			<td><?php echo $channelEvent['method'];?></td>
			<td><?php echo $channelEvent['created'];?></td>
			<td><?php echo $channelEvent['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'channel_events', 'action' => 'view', $channelEvent['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'channel_events', 'action' => 'edit', $channelEvent['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'channel_events', 'action' => 'delete', $channelEvent['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $channelEvent['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Channel Event', true), array('controller' => 'channel_events', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Channel Fields');?></h3>
	<?php if (!empty($channel['ChannelField'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Channel Id'); ?></th>
		<th><?php __('Field'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($channel['ChannelField'] as $channelField):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $channelField['id'];?></td>
			<td><?php echo $channelField['channel_id'];?></td>
			<td><?php echo $channelField['field'];?></td>
			<td><?php echo $channelField['created'];?></td>
			<td><?php echo $channelField['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'channel_fields', 'action' => 'view', $channelField['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'channel_fields', 'action' => 'edit', $channelField['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'channel_fields', 'action' => 'delete', $channelField['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $channelField['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Channel Field', true), array('controller' => 'channel_fields', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
