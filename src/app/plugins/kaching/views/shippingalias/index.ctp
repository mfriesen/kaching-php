<?php $this->pageTitle = "Kaching: Shipping Zones Alias Maintenance"; ?>

<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>

<?php echo $this->element('shippingzone/menu', array("zone"=>$this->data,'tab'=>'2')); ?>
<?php $id = $this->data['Shippingzone']['id']?>

<div class="tab-pane padding10">
	
	<div class="txt-right">
		<a href="/kaching/shippingaliases/edit/<?php echo $id?>" title="Add Alias"><img src='/kaching/img/button-new.png' alt='Add Amount'/></a>
	</div>
	<div class="clear">&nbsp;</div>
	
	<?php echo $this->element("shippingalias/alias-table")?>
	
</div>