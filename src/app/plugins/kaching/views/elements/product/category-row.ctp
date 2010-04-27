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
	<td style="padding-left: 20px;"><?php echo $form->checkbox('Category.category_id.['.$category['Category']['id'].']', array('id'=>"checkbox_$id" ,'value' => $category['Category']['id'])); ?></td>
	<td>
		<?php echo h($category['Category']['name']) ?>
	</td>
	<td class='txt-center'><?php echo $category['Category']['active'] == 1 ? "yes" : ""; ?></td>
</tr>