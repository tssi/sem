<div class="cities view">
<h2><?php  __('City');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $city['City']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $city['City']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Province'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($city['Province']['name'], array('controller' => 'provinces', 'action' => 'view', $city['Province']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $city['City']['is_active']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Zip Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $city['City']['zip_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Area Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $city['City']['area_code']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit City', true), array('action' => 'edit', $city['City']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete City', true), array('action' => 'delete', $city['City']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $city['City']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Provinces', true), array('controller' => 'provinces', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Province', true), array('controller' => 'provinces', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Barangays', true), array('controller' => 'barangays', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Barangay', true), array('controller' => 'barangays', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Barangays');?></h3>
	<?php if (!empty($city['Barangay'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('City Id'); ?></th>
		<th><?php __('Is Active'); ?></th>
		<th><?php __('Zip Code'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($city['Barangay'] as $barangay):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $barangay['id'];?></td>
			<td><?php echo $barangay['name'];?></td>
			<td><?php echo $barangay['city_id'];?></td>
			<td><?php echo $barangay['is_active'];?></td>
			<td><?php echo $barangay['zip_code'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'barangays', 'action' => 'view', $barangay['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'barangays', 'action' => 'edit', $barangay['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'barangays', 'action' => 'delete', $barangay['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $barangay['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Barangay', true), array('controller' => 'barangays', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
