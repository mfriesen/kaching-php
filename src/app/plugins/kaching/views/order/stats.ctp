<?php $this->pageTitle = "Kaching: Order Status"; ?>

<script type="text/javascript">
	$(document).ready(function()
	{
		$("#OrdersearchStartdate").datepicker({ dateFormat: 'yy-mm-dd', showOn: 'button', buttonImage: '/kaching/img/calendar_button_blue.gif', buttonImageOnly: true });
		$("#OrdersearchEnddate").datepicker({ dateFormat: 'yy-mm-dd', showOn: 'button', buttonImage: '/kaching/img/calendar_button_blue.gif', buttonImageOnly: true });
	});
</script>

<div class="tab-pane padding10">

	<?php echo $form->create('Orderstat', array('action'=>'index','class'=>'inline')); ?>
	
	<br />
	<div class="span-24"><h4><strong>Most Popular Products</strong></h4></div>
	
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
	<div class="clear"></div>
	
	<br />
	<?php echo $this->element("order/stats-table")?>
	<br />
	
	<div class="span-24">
	<?php echo $this->element('paginator-links'); ?>
	</div>
	<div class="clear"></div>
</div>