<?php $parent_id = isset($category) ? $category['Category']['parent_id'] : null; ?>
<?php $category_id = isset($category) ? $category['Category']['id'] : null; ?>
<?php $categories = $parent_id != null ? 
	$this->requestAction("/kaching/carts/get_categories/parent:$category_id") : $this->requestAction("/kaching/carts/get_categories"); ?>
	
<ul class="side-box">
	<li><h4><strong><a href='/'>Categories</a></strong></h4></li>
	
	<?php if ($parent_id != null) { ?>
		<li><a href="/kaching/carts/category/<?php echo $parent_id?>">...</a></li>
	<?php } ?>
	
	<?php foreach($categories as $category): ?>
	
		<?php $id = $category['Category']['id']; ?>
		<?php $page = strlen($category['Category']['page']) > 0 ? "/category/" . $category['Category']['page'] : "/kaching/carts/category/$id"; ?>
		<?php $name = h($category['Category']['name'])?>
		
		<li>
			<a id='category_<?php echo $id;?>_link' class='side-box' href='<?php echo $page?>'>
				<?php echo "$name"; ?>
			</a>
		</li>
	
		<?php if ($category_id != null && $category_id == $id) { ?>
			<?php foreach($category['children'] as $category): ?>
				<?php $id = $category['Category']['id']; ?>
				<?php $page = strlen($category['Category']['page']) > 0 ? "/category/" . $category['Category']['page'] : "/kaching/carts/category/$id"; ?>
				<?php $name = h($category['Category']['name'])?>
			
				<li>
					<a id='category_<?php echo $id;?>_link' class='side-box' href='<?php echo $page?>'>
						&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$name"; ?>
					</a>
				</li>
			<?php endforeach; ?>
		<?php } ?>
								
	<?php endforeach; ?>
	
</ul>