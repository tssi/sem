<div class="channelEvents index">
	<h2><?php __('Channel Events');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('channel_id');?></th>
			<th><?php echo $this->Paginator->sort('action');?></th>
			<th><?php echo $this->Paginator->sort('method');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($channelEvents as $channelEvent):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $channelEvent['ChannelEvent']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($channelEvent['Channel']['name'], array('controller' => 'channels', 'action' => 'view', $channelEvent['Channel']['id'])); ?>
		</td>
		<td><?php echo $channelEvent['ChannelEvent']['action']; ?>&nbsp;</td>
		<td><?php echo $channelEvent['ChannelEvent']['method']; ?>&nbsp;</td>
		<td><?php echo $channelEvent['ChannelEvent']['created']; ?>&nbsp;</td>
		<td><?php echo $channelEvent['ChannelEvent']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $channelEvent['ChannelEvent']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $channelEvent['ChannelEvent']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $channelEvent['ChannelEvent']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $channelEvent['ChannelEvent']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Channel Event', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Channels', true), array('controller' => 'channels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel', true), array('controller' => 'channels', 'action' => 'add')); ?> </li>
	</ul>
</div>