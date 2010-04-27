<?php echo $this->element('header', array('plugin'=>'kaching')); ?>

<h2>Shipping Zones Help</h2>

<h3>Shipping Overview</h3>
<p>
Setting up shipping in Kaching is based around the idea of setting up different shipping zones.  
Each shipping zone can setup shipping pricing by product weight or flat rate if shipping weight is set to 0.
</p>

<h3>Shipping Alias</h3>
<p>
Kaching has the concept of shipping aliases for shipping zones.  This allows one to associate a country / region with a shipping zone.
The country and region are required, but you can narrow the shipping zones by adding a city or postal / zip code.
</p>
<p>NOTE: If country has the ID of CA (for canada) only the first 3 characters of the postal code is needed.</p>