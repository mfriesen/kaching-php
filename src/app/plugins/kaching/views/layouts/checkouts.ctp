<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title><?php echo $title_for_layout?></title>
	
	<?php echo $this->element('css/bluecssprint', array('plugin'=>'kaching')); ?>
	<?php echo $html->css('/kaching/css/main-0.51.css') ?>
	<?php echo $html->css('/kaching/css/menu.css'); ?>
	<?php echo $html->css('/kaching/css/sample-store/main.css'); ?>
		
	<?php Header("Cache-Control: no-cache, must-revalidate"); ?>
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="cache-control" content="no-cache" /> 
	
	<?php if (env("HTTPS")) { ?>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<?php } else { ?>
		<script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<?php } ?>
	
	<?php echo $scripts_for_layout ?>
</head>

<body>

<div class="container">
	
	<?php echo $this->element("sample-store/banner")?>

	<?php echo $this->element("sample-store/menu")?>
	
	<div class="tab-pane padding10">
		
		<?php echo $this->element("sample-store/left-menu")?>
		
		<div class="span-18 span-18-padding10 last">
			<?php echo $content_for_layout ?>
		</div>
		<div class="clear"></div>

	</div>

</div>

<?php echo $this->element('google/google-analytics', array('plugin'=>'kaching')); ?>
	
</body>
</html>