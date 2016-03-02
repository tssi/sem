<div class="webhookFields view">
<h2><?php  __('Webhook Field');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $webhookField['WebhookField']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Webhook'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($webhookField['Webhook']['id'], array('controller' => 'webhooks', 'action' => 'view', $webhookField['Webhook']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Field Source'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $webhookField['WebhookField']['field_source']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Field Target'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $webhookField['WebhookField']['field_target']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $webhookField['WebhookField']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $webhookField['WebhookField']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Webhook Field', true), array('action' => 'edit', $webhookField['WebhookField']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Webhook Field', true), array('action' => 'delete', $webhookField['WebhookField']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $webhookField['WebhookField']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Webhook Fields', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Webhook Field', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Webhooks', true), array('controller' => 'webhooks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Webhook', true), array('controller' => 'webhooks', 'action' => 'add')); ?> </li>
	</ul>
</div>
