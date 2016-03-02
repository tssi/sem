<div class="webhooks view">
<h2><?php  __('Webhook');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $webhook['Webhook']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Event Source'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($webhook['EventSource']['id'], array('controller' => 'channel_events', 'action' => 'view', $webhook['EventSource']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Event Target'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($webhook['EventTarget']['id'], array('controller' => 'channel_events', 'action' => 'view', $webhook['EventTarget']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $webhook['Webhook']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $webhook['Webhook']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Webhook', true), array('action' => 'edit', $webhook['Webhook']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Webhook', true), array('action' => 'delete', $webhook['Webhook']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $webhook['Webhook']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Webhooks', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Webhook', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Channel Events', true), array('controller' => 'channel_events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Source', true), array('controller' => 'channel_events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Webhook Fields', true), array('controller' => 'webhook_fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Webhook Field', true), array('controller' => 'webhook_fields', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Webhook Fields');?></h3>
	<?php if (!empty($webhook['WebhookField'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Webhook Id'); ?></th>
		<th><?php __('Field Source'); ?></th>
		<th><?php __('Field Target'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($webhook['WebhookField'] as $webhookField):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $webhookField['id'];?></td>
			<td><?php echo $webhookField['webhook_id'];?></td>
			<td><?php echo $webhookField['field_source'];?></td>
			<td><?php echo $webhookField['field_target'];?></td>
			<td><?php echo $webhookField['created'];?></td>
			<td><?php echo $webhookField['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'webhook_fields', 'action' => 'view', $webhookField['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'webhook_fields', 'action' => 'edit', $webhookField['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'webhook_fields', 'action' => 'delete', $webhookField['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $webhookField['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Webhook Field', true), array('controller' => 'webhook_fields', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
