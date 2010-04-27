<?php $inline = isset($inline) ? $inline : true; ?>

<?php
if ($inline) { 
	echo $javascript->codeBlock("google.load('jquery', '1.4.1');", array('inline'=>$inline, 'safe'=>false));
} else {
	$javascript->codeBlock("google.load('jquery', '1.4.1');", array('inline'=>$inline, 'safe'=>false));
}
?>