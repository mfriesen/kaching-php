<?php $id = isset($this->data['Storesmtp']['id']) ? $this->data['Storesmtp']['id'] : ""; ?>

<?php echo $form->hidden('Storesmtp.id', array('value'=>$id));?>

<hr />
<h4 class='margin0'><strong>Email</strong></h4>

<div class="span-3 txt-right"><label class='txt-right' for="smtp_server">SMTP Server:</label></div>
<div class="span-20 last">
	<?php echo $form->text("Storesmtp.smtp_server", array("size"=>"40", "maxlength"=>"64")) ?>
	<?php echo $form->error("Storesmtp.smtp_server") ?>
</div>
<div class="span-3 txt-right"><label class='txt-right' for="smtp_port">SMTP Port:</label></div>
<div class="span-20 last">
	<?php echo $form->text("Storesmtp.smtp_port", array("size"=>"5", "maxlength"=>"10")) ?>
	<?php echo $form->error("Storesmtp.smtp_port") ?>
</div>
<div class="clear"></div>

<div class="span-3 txt-right"><label class='txt-right' for="smtp_server">SMTP Username:</label></div>
<div class="span-20 last">
	<?php echo $form->text("Storesmtp.smtp_username", array("size"=>"40", "maxlength"=>"64")) ?>
	<?php echo $form->error("Storesmtp.smtp_username") ?>
</div>
<div class="span-3 txt-right"><label class='txt-right' for="smtp_port">SMTP Password:</label></div>
<div class="span-20 last">
	<?php echo $form->text("Storesmtp.smtp_password", array("type"=>"password", "size"=>"40", "maxlength"=>"64")) ?>
	<?php echo $form->error("Storesmtp.smtp_password") ?>
</div>
<div class="clear"></div>

<div class="span-3 txt-right"><label class='txt-right' for="smtp_server">Orders BCC:</label></div>
<div class="span-20 last">
	<?php echo $form->text("Storesmtp.order_bcc", array("size"=>"40", "maxlength"=>"64")) ?>
	<a class="tooltip" title="Send a BCC of all order to this address.<br/>NOTE: If order_bcc and smtp_username are the same this can cause problems on different mail servers."><img width='20' height='20' src='/kaching/img/info.png' alt='tax1'/></a>
	<?php echo $form->error("Storesmtp.order_bcc") ?>
</div>
<div class="clear"></div>