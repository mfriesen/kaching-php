<?php $this->pageTitle = "Kaching Login"; ?>

<div class="tab-pane padding10">

	<?php echo $form->create('User', array('action' => 'login', 'class'=>'inline'));?>

	<h4><strong>Login</strong></h4>
	
	<div class="span-3 txt-right"><label class='txt-right' for="email">Username:</label></div>
	<div class="span-20 last">
		<?php echo $form->text("User.username", array("size"=>"35", "maxlength"=>"35")) ?>
		<?php echo $form->error("User.username") ?>
	</div>	
	<div class="clear"></div>
	
	<div class="span-3 txt-right"><label class='txt-right' for="password">Password:</label></div>
	<div class="span-20 last">
		<?php echo $form->text("User.password", array("type"=>"password", "size"=>"35", "maxlength"=>"35")) ?>
		<?php echo $form->error("User.password") ?>
	</div>	
	<div class="clear"></div>
	
	<?php echo $form->end(array('label'=>'Sign In', "div"=>"padding10"));?>
</div>

<script type="text/javascript">
document.getElementById('UserUsername').focus();
</script>