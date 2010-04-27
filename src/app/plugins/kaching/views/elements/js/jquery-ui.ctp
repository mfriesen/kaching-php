<?php $inline = isset($inline) ? $inline : true; ?>

<?php echo $html->css('/kaching/css/smoothness/jquery-ui-1.7.1.css', 'stylesheet', array('media'=>'all'), $inline); ?>
<?php
if ($inline) { 
	echo $javascript->codeBlock("google.load('jqueryui', '1.7.2');", array('inline'=>$inline, 'safe'=>false));
} else {
	$javascript->codeBlock("google.load('jqueryui', '1.7.2');", array('inline'=>$inline, 'safe'=>false));
}
?>