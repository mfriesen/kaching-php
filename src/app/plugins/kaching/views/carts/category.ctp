<?php $categoryId = $category['Category']['id'] > -1 ? $category['Category']['id'] : "null"; ?>
<?php $categoryName =  h($category['Category']['name'])?>
<?php $priceFilter = array('0-40' => 'less $40', '40-55' => '$40 - $55', '55-75' => '$55 - $75', '75-100' => '$75 - $100', '100-'=>'more $100'); ?>

<br />
<p>Welcome to the Kaching Sample Store.  This store provide you with sample code of all the features of Kaching.</p>
<p>Please see our <a href="http://code.google.com/p/kaching-php">Project Page</a> for documentation on the installation and usage of Kaching.</p>

<h2><i>Category:</i>&nbsp;<?php echo $categoryName?> </h2>

Price Range:
&nbsp;&nbsp;
<a id='price_all' href='/kaching/carts/category/<?php echo $categoryId?>'>all</a>
<?php foreach($priceFilter as $key => $filter): ?>
	&nbsp;&nbsp;|&nbsp;&nbsp;
	<a id='price_<?php echo $key?>' href='/kaching/carts/category/<?php echo $categoryId?>/limit:10/store:<?php echo $store['Store']['number']?>/pricefilter:<?php echo $key?>'><?php echo $filter?></a>
<?php endforeach; ?>

<hr/>

<?php if ($category['Category']['active'] == 0) { ?>
	<div class="txt-center"><h3>Category is not enabled</h3></div>
<?php } else if (sizeof($products) == 0) { ?>
	<div class="txt-center"><h3>No Products Found matching search criteria</h3></div>
<?php } else { ?>
	
	<?php foreach ($products as $index => $product): ?>
		<?php echo $this->element("cart/product-box", array("product"=>$product))?>
	<?php endforeach; ?>

	<div class="clear"></div>
	<?php if ($limit > 0) { echo $this->element('paginator-links'); }?>
		
<?php } ?>