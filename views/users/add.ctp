<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('name');
		echo $this->Form->input('avatar');
		echo $this->Form->input('avatar_big');
		echo $this->Form->input('point');
		echo $this->Form->input('level');
		echo $this->Form->input('exp');
		echo $this->Form->input('status');
		echo $this->Form->input('group_id');
		echo $this->Form->input('referrer');
		echo $this->Form->input('ip');
		echo $this->Form->input('statusflag');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stat Accesses', true), array('controller' => 'stat_accesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stat Access', true), array('controller' => 'stat_accesses', 'action' => 'add')); ?> </li>
	</ul>
</div>