<?php $id = $category['Category']['id']; ?>

<?php
$index = implode("-", $indexes);
$size = sizeof($indexes);
$class = "";

if ($size > 1) {
	$subindex = array_slice($indexes, 0, sizeof($indexes) - 1);
	$class = "class='child-of-node-" .  implode("-", $subindex) . "'";	
}
?>

<tr id="node-<?php echo $index?>" <?php echo $class?>>
	<td style="padding-left: 20px;">
		<?php echo h($category['Category']['name']) ?>
	</td>
	<td><?php echo $category['Category']['page']?></td>
	<td class='txt-center'><?php echo $category['Category']['active'] == 1 ? "yes" : ""; ?></td>
	<td class='txt-right'>
		<a href="/kaching/categories/edit/<?php echo $id?>" title="Edit Category">edit</a>
		&nbsp;|&nbsp;
		<?php $l = "Do you want to delete Category " . $category['Category']['name'] . "?"; ?>
		<?php echo $ajax->link('delete',array( 'controller' => 'categories', 'action' => 'delete', $id), array( 'update' => 'category','complete' => 'location.reload(true);' ), $l); ?> 			
	</td>
</tr>