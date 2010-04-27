<?php $this->pageTitle = "Kaching: Order Search"; ?>

<?php $statusMessages = $orderUtil->getOrderStatusMessages();?>
<?php $statusColours = $orderUtil->getOrderStatusColours();?>

<script type="text/javascript">
	$(document).ready(function()
	{
		$("#OrdersearchStartdate").datepicker({ dateFormat: 'yy-mm-dd', showOn: 'button', buttonImage: '/kaching/img/calendar_button_blue.gif', buttonImageOnly: true });
		$("#OrdersearchEnddate").datepicker({ dateFormat: 'yy-mm-dd', showOn: 'button', buttonImage: '/kaching/img/calendar_button_blue.gif', buttonImageOnly: true });
	});
</script>

<div class="tab-pane padding10">
	<?php echo $form->create('Ordersearch', array('action'=>'index','class'=>'inline')); ?>
	
	<br />
	<div class="span-24"><h4 class='margin0'><strong>Order Searches</strong></h4></div>
	<div class="span-24">If StartDate and EndDate are blank only Incomplete Order(s) will be shown</div>
	
	<div class="span-6">
		<?php 
			echo $form->input('Ordersearch.startdate', 
				array('label' => __('Start Date:&nbsp;', true), 'type' => 'text', 'size' => '10', 'maxlength'=>'10', 
				'id'=>'OrdersearchStartdate'));
		?>
	</div>
	
	<div class="span-6 last">	
		<?php 
			echo $form->input('Ordersearch.enddate', 
				array('label' => __('&nbsp;End Date:&nbsp;', true), 'type' => 'text', 'size' => '10', 'maxlength'=>'10', 
				'id'=>'OrdersearchEnddate'));
		?>
	</div>
	<?php echo $form->end(array('div'=>'span-2', "label"=>"/kaching/img/button-search.png")); ?>
	<div class="clear">&nbsp;</div>
	
	<?php echo $this->element("order/search-table")?>
	
	<?php echo $this->element('paginator-links'); ?>

	<div class="clear"></div>
</div>