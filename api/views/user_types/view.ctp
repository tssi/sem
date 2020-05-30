<div class="userTypes view">
<h2><?php  __('User Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userType['UserType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userType['UserType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userType['UserType']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userType['UserType']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Type', true), array('action' => 'edit', $userType['UserType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete User Type', true), array('action' => 'delete', $userType['UserType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userType['UserType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Types', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Type', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Grants', true), array('controller' => 'user_grants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Grant', true), array('controller' => 'user_grants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related User Grants');?></h3>
	<?php if (!empty($userType['UserGrant'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Type Id'); ?></th>
		<th><?php __('Master Module Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($userType['UserGrant'] as $userGrant):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $userGrant['id'];?></td>
			<td><?php echo $userGrant['user_type_id'];?></td>
			<td><?php echo $userGrant['master_module_id'];?></td>
			<td><?php echo $userGrant['created'];?></td>
			<td><?php echo $userGrant['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'user_grants', 'action' => 'view', $userGrant['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'user_grants', 'action' => 'edit', $userGrant['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'user_grants', 'action' => 'delete', $userGrant['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userGrant['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Grant', true), array('controller' => 'user_grants', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Users');?></h3>
	<?php if (!empty($userType['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Type Id'); ?></th>
		<th><?php __('Username'); ?></th>
		<th><?php __('Department Id'); ?></th>
		<th><?php __('Password'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Login Failed'); ?></th>
		<th><?php __('Ip Failed'); ?></th>
		<th><?php __('Login Success'); ?></th>
		<th><?php __('Ip Success'); ?></th>
		<th><?php __('Password Changed'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($userType['User'] as $user):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $user['user_type_id'];?></td>
			<td><?php echo $user['username'];?></td>
			<td><?php echo $user['department_id'];?></td>
			<td><?php echo $user['password'];?></td>
			<td><?php echo $user['status'];?></td>
			<td><?php echo $user['login_failed'];?></td>
			<td><?php echo $user['ip_failed'];?></td>
			<td><?php echo $user['login_success'];?></td>
			<td><?php echo $user['ip_success'];?></td>
			<td><?php echo $user['password_changed'];?></td>
			<td><?php echo $user['created'];?></td>
			<td><?php echo $user['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'users', 'action' => 'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
