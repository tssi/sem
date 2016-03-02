<div class="webhookFields index">
	<h2><?php __('Webhook Fields');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('webhook_id');?></th>
			<th><?php echo $this->Paginator->sort('field_source');?></th>
			<th><?php echo $this->Paginator->sort('field_target');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($webhookFields as $webhookField):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $webhookField['WebhookField']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($webhookField['Webhook']['id'], array('controller' => 'webhooks', 'action' => 'view', $webhookField['Webhook']['id'])); ?>
		</td>
		<td><?php echo $webhookField['WebhookField']['field_source']; ?>&nbsp;</td>
		<td><?php echo $webhookField['WebhookField']['field_target']; ?>&nbsp;</td>
		<td><?php echo $webhookField['WebhookField']['created']; ?>&nbsp;</td>
		<td><?php echo $webhookField['WebhookField']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $webhookField['WebhookField']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $webhookField['WebhookField']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $webhookField['WebhookField']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $webhookField['WebhookField']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Webhook Field', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Webhooks', true), array('controller' => 'webhooks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Webhook', true), array('controller' => 'webhooks', 'action' => 'add')); ?> </li>
	</ul>
</div>