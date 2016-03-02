<div class="channelFields index">
	<h2><?php __('Channel Fields');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('channel_id');?></th>
			<th><?php echo $this->Paginator->sort('field');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($channelFields as $channelField):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $channelField['ChannelField']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($channelField['Channel']['name'], array('controller' => 'channels', 'action' => 'view', $channelField['Channel']['id'])); ?>
		</td>
		<td><?php echo $channelField['ChannelField']['field']; ?>&nbsp;</td>
		<td><?php echo $channelField['ChannelField']['created']; ?>&nbsp;</td>
		<td><?php echo $channelField['ChannelField']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $channelField['ChannelField']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $channelField['ChannelField']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $channelField['ChannelField']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $channelField['ChannelField']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Channel Field', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Channels', true), array('controller' => 'channels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel', true), array('controller' => 'channels', 'action' => 'add')); ?> </li>
	</ul>
</div>