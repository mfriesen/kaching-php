<?php $this->pageTitle = "Kaching: Shipping Zones Maintenance"; ?>

<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>

<?php echo $this->element('shippingzone/menu', array("zone"=>$this->data,'tab'=>'1')); ?>
<?php $id = $this->data['Shippingzone']['id']?>

<div class="tab-pane padding10">
	
	<div class="txt-right">
		<a href="/kaching/shippingamounts/edit/<?php echo $id?>" title="Add Amount"><img src='/kaching/img/button-new.png' alt='Add Amount'/></a>
	</div>
	<div class="clear">&nbsp;</div>
	
	<?php echo $this->element("shippingamount/amounts-table")?>
	
</div>