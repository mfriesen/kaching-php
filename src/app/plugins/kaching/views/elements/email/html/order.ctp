<html>
<body>
<div><h3>Thanks for shopping at <?php echo $store['Store']['name']?>&nbsp;(<?php echo $store['Store']['website']?>)</h3></div>
<h4>Order Summary</h4>
<?php echo $this->element("checkout/form-review", array('plugin'=>'kaching')); ?>
<div class='clear'>&nbsp;</div>

<?php echo $this->element('order/items', array('plugin'=>'kaching')) ?>

</body>
</html>