<?php $this->pageTitle = "Kaching User Maintenance"; ?>

<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>

<div class="tab-pane padding10">
	<?php echo $form->create('Users', array('action'=>'search', 'class'=>'inline')); ?>
	
	<br />
	<div class="span-16"><h4><strong>Users</strong></h4></div>
	<div class="span-8 span-8-padding10 txt-right last">
		<a href="/kaching/users/edit" title="Add User"><img src='/kaching/img/button-new.png' alt='Add User' /></a>
	</div>
	<div class="clear"></div>
	<?php echo $form->end();?>
		
	<?php echo $this->element("user/search-table")?>

</div>