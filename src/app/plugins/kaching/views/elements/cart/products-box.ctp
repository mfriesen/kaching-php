<?php $columns = isset($columns) ? $columns : 3; ?>

<div class='span-18 products-box'>
	<?php
	$plist = array_chunk($products, $columns);
	foreach ($plist as $pindex => $pproducts):
		?>
		<hr style='margin-bottom:0;'/>
		<?php
		foreach ($pproducts as $index => $product):
			echo $this->element("cart/product-box", array("product"=>$product, "index"=>$index, "columns"=>$columns));
		endforeach;
		?>
		<?php
	endforeach;	
	?>
</div>
<div class="clear"><hr/></div>
<?php if ($limit > 0) { echo $this->element('paginator-links'); }?>