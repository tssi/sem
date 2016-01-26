<div class="provinces view">
<h2><?php  __('Province');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $province['Province']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $province['Province']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Country'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($province['Country']['name'], array('controller' => 'countries', 'action' => 'view', $province['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $province['Province']['is_active']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Seq Order'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $province['Province']['seq_order']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Province', true), array('action' => 'edit', $province['Province']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Province', true), array('action' => 'delete', $province['Province']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $province['Province']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Provinces', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Province', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities', true), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City', true), array('controller' => 'cities', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Cities');?></h3>
	<?php if (!empty($province['City'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Province Id'); ?></th>
		<th><?php __('Is Active'); ?></th>
		<th><?php __('Zip Code'); ?></th>
		<th><?php __('Area Code'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($province['City'] as $city):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $city['id'];?></td>
			<td><?php echo $city['name'];?></td>
			<td><?php echo $city['province_id'];?></td>
			<td><?php echo $city['is_active'];?></td>
			<td><?php echo $city['zip_code'];?></td>
			<td><?php echo $city['area_code'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'cities', 'action' => 'view', $city['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'cities', 'action' => 'edit', $city['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'cities', 'action' => 'delete', $city['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $city['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New City', true), array('controller' => 'cities', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
