Thanks for shopping at <?php echo $store['Store']['name']?>&nbsp;(<?php echo $store['Store']['website']?>)
Order Summary
<?php echo $this->element("checkout/form-review", array('plugin'=>'kaching')); ?>

<?php echo $this->element('order/items', array('plugin'=>'kaching')) ?>