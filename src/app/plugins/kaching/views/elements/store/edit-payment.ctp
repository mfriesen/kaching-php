<?php $paymentProcess = array("manual" => "Manual", "paypal-pro" => "Paypal Website Payments Pro"); ?>
<?php $currency = array("AUD" => "Australian Dollar", "BRL"=>"Brazilian Real","CAD"=>"Canadian Dollar", "CZK"=>"Czech Koruna",
"DKK"=>"Danish Krone", "EUR"=>"Euro", "HKD"=>"Hong Kong Dollar", "HUF"=>"Hungarian Forint", "ILS"=>"Israeli New Sheqel",
"JPY"=>"Japanese Yen", "MYR"=>"Malaysian Ringgit", "MXN"=>"Mexican Peso", "NOK"=>"Norwegian Krone", "NZD"=>"New Zealand Dollar",
"PHP"=>"Philippine Peso", "PLN"=>"Polish Zloty", "GBP"=>"Pound Sterling", "SGD"=>"Singapore Dollar", "SEK"=>"Swedish Krona",
"CHF"=>"Swiss Franc", "TWD"=>"Taiwan New Dollar", "THB"=>"Thai Baht", "USD"=>"U.S. Dollar"); 
?>
<?php $ccOptions = array("0"=>"Delete when Order Completed", "1"=>"Always Keep")?>

<hr />
<h4 class='margin0'><strong>Payments</strong></h4> 

<div class="span-3 txt-right"><label class='txt-right' for="paymentprocess">Payment Process:</label></div>
<div class="span-9">
	<?php echo $form->select("Store.payment_process", $paymentProcess, null, array("empty"=>false)) ?>
	<a class="tooltip" title="How Order Payments are processed.<br/>Manual - for stores that have a debit machine and prefer to process order payments manually.">
		<img width='20' height='20' src='/kaching/img/info.png' alt='payment process'/>
	</a>
	<?php echo $form->error("Store.payment_process") ?>
</div>
<div class="span-3 txt-right"><label class='txt-right' for="currency">Currency:</label></div>
<div class="span-9 span-9-padding10 last">
	<?php echo $form->select("Store.currency", $currency, null, array("empty"=>false)) ?>
	<a class="tooltip" title="Required if using Paypal Website Payments Pro">
		<img width='20' height='20' src='/kaching/img/info.png' alt='store currency'/>
	</a>
	<?php echo $form->error("Store.currency") ?>
</div>
<div class="clear"></div>

<div class="span-3 txt-right"><label class='txt-right' for="credit_cards">Credit Card(s):</label></div>
<div class="span-9">
	<?php echo $form->select("Store.credit_cards", $ccOptions, null, array("empty"=>false)) ?>
	<a class="tooltip" title="How to handle Credit Cards security after Order is Completed.<br/>Either: Delete Immediately or Never Delete.">
		<img width='20' height='20' src='/kaching/img/info.png' alt='credit card info'/>
	</a>
	<?php echo $form->error("Store.credit_cards") ?>
</div>
<div class="clear"></div>