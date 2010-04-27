<?php 
$thumbnailUrl = Configure::read('kaching.product-thumbnail.url');
$thumbnailDir = Configure::read("kaching.product-thumbnail.dir");
?>

<?php foreach($this->data['OrderDetail'] as $index => $detail): ?>

	<?php list($id, $number, $title, $description, $keywords, $thumbnail, $image, $page, $inserted, $modified) = $cart->getProduct($detail); ?>
	<?php $title = h($title) ?>
	
	<?php $total = number_format($detail['retail'], 2) ?>
		
	<tr valign='top'>
		<td>
			<table>
				<tr>
					<td style='border:0px; width:200px;'>
												
						<?php if (is_file($thumbnailDir . "/$thumbnail")) { ?>
							<img alt='<?php echo "$number $title"?>' src='<?php echo $thumbnailUrl?>/<?php echo $thumbnail?>' border='0'/>
						<?php } else { ?>
							<img alt='<?php echo "$number $title"?>' src='/kaching/img/no-image.jpg' border='0'/>
						<?php } ?>
						
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