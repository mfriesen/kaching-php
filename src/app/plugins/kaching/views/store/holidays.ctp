<?php $this->set("title_for_layout", "Kaching Store Holidays") ?>

<script type="text/javascript">
	jQuery(document).ready(function()
	{
		jQuery("#HolidayDate").datepicker({ dateFormat: 'yy-mm-dd', showOn: 'button', buttonImage: '/kaching/img/calendar_button_blue.gif', buttonImageOnly: true });
	});
</script>

<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>

<?php $id = $this->data['Store']['id']; ?>
<?php echo $this->element('store/menu', array("store"=>$this->data,'tab'=>'2')); ?>

<div class="tab-pane padding10">
	
	<?php echo $form->create('Store', array('action'=>"addholiday", 'class'=>'inline')); ?>	

		Store Holiday:&nbsp;&nbsp;
		<?php 
			echo $form->input('StoreHoliday.date', 
				array('label' => __('Holiday Date:&nbsp;', true), 'type' => 'text', 'size' => '10', 'maxlength'=>'10', 
				'id'=>'HolidayDate'));
		?>
	
	<?php echo $form->end(array('label'=>"/kaching/img/button-add.png")); ?>
	
	<div class="clear">&nbsp;</div>
			
	<table id='shippingTable_<?php echo $id?>' class='simple'>
		<tr><th>Holiday</th><th class='txt-right'>Action</th></tr>
	
		<?php foreach($this->data['StoreHoliday'] as $holiday): ?>
		
			<?php $holidayId = $holiday['id']; ?>			
			<?php $dateFormat = $date->formatDate($holiday['date'], "F d, Y (l)"); ?>
			<tr>
				<td><?php echo $dateFormat?></td>
				<td class='txt-right'>
					<?php $l = "Do you want to delete Holiday " . $dateFormat . "?"; ?>
					<?php echo $ajax->link('delete',array( 'controller' => 'stores', 'action' => 'deleteholiday', $id, $holidayId), array( 'update' => 'store','complete' => 'location.reload(true);' ), $l); ?> 			
				</td>
			</tr>
		
		<?php endforeach; ?>
	</table>
	
</div>