<?php $this->set("title_for_layout", "Kaching Change Password") ?>

<?php echo $form->create('User', array('action' => 'changepassword', 'class'=>'inline'));?>

<div class="tab-pane padding10">

<h4 class='padding10'><strong>Change Password</strong></h4>

<div class="column span-4 txt-right"><label class='txt-right' for="email">Old Password:</label></div>
<div class="column span-19 last">
	<?php echo $form->text("User.oldpassword", array("type"=>"password", "size"=>"35", "maxlength"=>"35")) ?>
	<?php echo $form->error("User.oldpassword") ?>
</div>	
<div class="clear"></div>

<div class="column span-4 txt-right"><label class='txt-right' for="password">New Password:</label></div>
<div class="column span-19 last">
	<?php echo $form->text("User.newpassword1", array("type"=>"password", "size"=>"35", "maxlength"=>"35")) ?>
	<?php echo $form->error("User.newpassword1") ?>
</div>	
<div class="clear"></div>

<div class="column span-4 txt-right"><label class='txt-right' for="password">New Password Confirm:</label></div>
<div class="column span-19 last">
	<?php echo $form->text("User.newpassword2", array("type"=>"password", "size"=>"35", "maxlength"=>"35")) ?>
	<?php echo $form->error("User.newpassword2") ?>
</div>	
<div class="clear"></div>

<?php echo $form->end(array('label'=>'Change Password', "div"=>"padding10"));?>

</div>

<script type="text/javascript">
document.getElementById('UserOldpassword').focus();
</script>