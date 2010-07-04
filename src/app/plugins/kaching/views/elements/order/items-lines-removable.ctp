<?php foreach($this->data['OrderDetail'] as $index => $detail): ?>

	<?php list($id, $number, $title, $description, $keywords, $thumbnail, $image, $page, $inserted, $modified) = $cart->getProduct($detail); ?>
	<?php $title = h($title) ?>
	
	<?php $total = number_format($detail['retail'], 2) ?>
		
	<tr valign='top'>
		<td>
			<table>
				<tr>
					<td style='border:0px;'><a href='/kaching/carts/remove/index:<?php echo $index?>'><img border='0' src='/kaching/img/cart_remove.png'/></a></td>
					<td style='border:0px;'>
						<?php $thumbnailUrl = $cart->thumbnail_url($detail); ?>						
						<img alt='<?php echo "$number $title"?>' src='<?php echo $thumbnailUrl?>' border='0'/>						
					</td>
					<td style='border:0px;'>
						<h4>Product: <?php echo $number?></h4>
						<h4><?php echo $title ?></h4>
					</td>
				</tr>
			</table>
		</td>
		<td class='txt-right' style='width: 100px'><span id='total_<?php echo $index?>'>$<?php echo $total?></span></td>
	</tr>
<?php endforeach; ?>