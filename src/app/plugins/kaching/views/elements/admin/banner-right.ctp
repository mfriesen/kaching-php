<div class="span-12 banner txt-right last white">
	<br />
	<?php echo date("l, F j, Y, g:i a");?>
	<?php if (isset($user)) { ?> 
	&nbsp;|&nbsp;<a class='white' id='logout-link' href="/kaching/users/logout">Logout</a>
	<?php } ?>
</div>