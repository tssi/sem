<div class="webhooks index">
	<h2><?php __('Webhooks');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('event_source');?></th>
			<th><?php echo $this->Paginator->sort('event_target');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($webhooks as $webhook):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $webhook['Webhook']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($webhook['EventSource']['id'], array('controller' => 'channel_events', 'action' => 'view', $webhook['EventSource']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($webhook['EventTarget']['id'], array('controller' => 'channel_events', 'action' => 'view', $webhook['EventTarget']['id'])); ?>
		</td>
		<td><?php echo $webhook['Webhook']['created']; ?>&nbsp;</td>
		<td><?php echo $webhook['Webhook']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $webhook['Webhook']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $webhook['Webhook']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $webhook['Webhook']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $webhook['Webhook']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Webhook', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Channel Events', true), array('controller' => 'channel_events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Source', true), array('controller' => 'channel_events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Webhook Fields', true), array('controller' => 'webhook_fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Webhook Field', true), array('controller' => 'webhook_fields', 'action' => 'add')); ?> </li>
	</ul>
</div>