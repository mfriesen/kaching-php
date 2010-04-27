<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title><?php echo $title_for_layout?></title>
	
	<?php echo $this->element('header', array('plugin'=>'kaching')) ?>
		
	<?php echo $this->element('js/jsapi', array('plugin'=>'kaching')) ?>
	
	<?php echo $this->element('js/jquery', array('plugin'=>'kaching')) ?>	
	<?php echo $this->element('js/jquery-ui', array('plugin'=>'kaching')) ?>

	<?php echo $javascript->link('/kaching/js/jquery.hoverIntent.js') ?>
		
	<?php echo $scripts_for_layout ?>
	
</head>

<body>
	
<div class="container">

	<?php echo $this->element("admin/banner-left", array('plugin'=>'kaching'))?>
	<?php echo $this->element("admin/banner-right", array('plugin'=>'kaching'))?>

	<?php echo $this->element('admin/menu', array('plugin'=>'kaching')); ?>

	<?php echo $content_for_layout ?>

</div>

</body>
</html>