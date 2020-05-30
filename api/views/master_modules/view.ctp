<div class="masterModules view">
<h2><?php  __('Master Module');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterModule['MasterModule']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterModule['MasterModule']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Link'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterModule['MasterModule']['link']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Parent'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterModule['MasterModule']['is_parent']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Child'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterModule['MasterModule']['is_child']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sequence'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterModule['MasterModule']['sequence']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterModule['MasterModule']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterModule['MasterModule']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterModule['MasterModule']['created_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterModule['MasterModule']['modified_by']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Master Module', true), array('action' => 'edit', $masterModule['MasterModule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Master Module', true), array('action' => 'delete', $masterModule['MasterModule']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $masterModule['MasterModule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Master Modules', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Master Module', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Grants', true), array('controller' => 'user_grants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Grant', true), array('controller' => 'user_grants', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related User Grants');?></h3>
	<?php if (!empty($masterModule['UserGrant'])):?>
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
		foreach ($masterModule['UserGrant'] as $userGrant):
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
