<div class="userGrants view">
<h2><?php  __('User Grant');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userGrant['UserGrant']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($userGrant['UserType']['name'], array('controller' => 'user_types', 'action' => 'view', $userGrant['UserType']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Master Module'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($userGrant['MasterModule']['name'], array('controller' => 'master_modules', 'action' => 'view', $userGrant['MasterModule']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userGrant['UserGrant']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userGrant['UserGrant']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Grant', true), array('action' => 'edit', $userGrant['UserGrant']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete User Grant', true), array('action' => 'delete', $userGrant['UserGrant']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userGrant['UserGrant']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Grants', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Grant', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Types', true), array('controller' => 'user_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Type', true), array('controller' => 'user_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Master Modules', true), array('controller' => 'master_modules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Master Module', true), array('controller' => 'master_modules', 'action' => 'add')); ?> </li>
	</ul>
</div>
