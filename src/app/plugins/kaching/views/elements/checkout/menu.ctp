<?php $menu = array('Checkout', 'Review', 'Complete'); ?>

<?php
foreach($menu as $index => $m):

if ($index > 0)
	echo "&nbsp;->&nbsp;";

if (isset($selected) && $selected == $m)
	echo '<span style="color:red"><strong>';

echo $m;

if (isset($selected) && $selected == $m)
	echo '</strong></span>';
	
endforeach;
?>