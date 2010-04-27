<?php $this->pageTitle = "Kaching Mailinglist Maintenance"; ?>

<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>

<div class="tab-pane padding10">
	<?php echo $form->create('Mailinglist', array('action'=>'index', 'class'=>'inline')); ?>
	
	<br />
	<div class="span-16"><h4><strong>Mailing List</strong></h4></div>
	<div class="span-8 span-8-padding10 txt-right last">
		<a href="/kaching/mailinglists/edit" title="Add Email"><img src='/kaching/img/button-new.png' alt='Add Email' /></a>
	</div>
	<div class="clear"></div>
	
	<div class="span-13 last">
	<label class='txt-right' for="q">Query:</label>
		<?php echo $form->text("Mailinglist.q", array("size"=>"50", "maxlength"=>"50")) ?>
		<?php echo $form->error("Mailinglist.q") ?>
	</div>
	<?php echo $form->end(array('div'=>'span-2 last', "label"=>"/kaching/img/button-search.png")); ?>	
	<div class="clear"></div>
	
	<br />
	
	<?php echo $this->element("mailinglist/search-table")?>
	
</div>

<script type="text/javascript">
document.getElementById('MailinglistQ').focus();
</script>