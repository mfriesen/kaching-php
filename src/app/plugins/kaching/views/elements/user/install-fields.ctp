
<div class="span-4 txt-right"><label class='txt-right' for="username">Username:</label></div>
<div class="span-19 last">
	<?php echo $form->text("User.username", array("size"=>"50", "maxlength"=>"50")) ?>
	<?php echo $form->error("User.username") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="password">Password:</label></div>
<div class="span-19 last">
	<?php echo $form->text("User.password1", array("type"=>"password", "size"=>"50", "maxlength"=>"50")) ?>
	<?php echo $form->error("User.password1") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="password2">Confirm Password:</label></div>
<div class="span-19 last">
	<?php echo $form->text("User.password2", array("type"=>"password", "size"=>"50", "maxlength"=>"50")) ?>
	<?php echo $form->error("User.password2") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="store">Group:</label></div>
<div class="span-19 last">
	<?php echo $form->select("User.group_id", $groups, null, array(), false) ?>
	<?php echo $form->error("User.group_id") ?>
</div>	
<div class="clear"></div>

<?php $activeList = array('1'=>'Active'); ?>
<div class="span-4 txt-right"><label for="active">Active:</label></div>
<div class="span-19 span-9-border-1 last">
	<?php echo $form->select("User.active", $activeList, null, array(), false) ?>
	<?php echo $form->error("User.active") ?>
</div>	
<div class="clear"></div>