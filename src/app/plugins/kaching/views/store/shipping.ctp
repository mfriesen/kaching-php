<?php $this->set("title_for_layout", "Kaching Store Shipping Zones") ?>

<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>

<?php $id = $this->data['Store']['id']; ?>
<?php echo $this->element('store/menu', array("store"=>$this->data,'tab'=>'1')); ?>

<div class="tab-pane padding10">
	
	<?php if (!empty($zones)) { ?>
		<?php echo $form->create('Store', array('action'=>'addzone', 'class'=>'inline')); ?>
			<?php echo $form->hidden('id');?>
			Shipping Zone:&nbsp;&nbsp;
			<?php echo $form->select("Shippingzone.id", $zones, null, array(), false) ?>
		
		<?php echo $form->end(array('label'=>"/kaching/img/button-add.png")); ?>
	<?php } else { ?>
	No shipping zones available to add.  Click here to <a href='/kaching/shippingzones/index'>add shipping zones</a>
	<?php } ?>
	
	<div class="clear">&nbsp;</div>
			
	<table id='shippingTable_<?php echo $id?>' class='simple'>
		<tr><th>Shipping Zone</th><th class='txt-right'>Action</th></tr>
	
		<?php foreach($this->data['Shippingzone'] as $zone): ?>
		
			<?php $zoneId = $zone['id']; ?>	
			<tr>
				<td><?php echo $zone['label'];?></td>
				<td class='txt-right'>
					<?php $l = "Do you want to delete Shipping Amount " . $zone['label'] . "?"; ?>
					<?php echo $ajax->link('delete',array( 'controller' => 'stores', 'action' => 'deletezone', $id, $zoneId), array( 'update' => 'store','complete' => 'location.reload(true);' ), $l); ?> 			
				</td>
			</tr>
		
		<?php endforeach; ?>
	</table>
	
</div>