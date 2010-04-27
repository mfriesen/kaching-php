<div class="clear"></div>
<div id="menu">
<ul class="menutabs">
	<?php if (isset($user)) { ?>
		<?php echo $this->element("admin/menu-tabs", array('plugin'=>'kaching'))?>
	<?php } ?>
</ul>
</div>

<script type="text/javascript">

	jQuery(document).ready(function() {
		
		jQuery('.dropdown').each(function () {
			jQuery(this).parent().eq(0).hoverIntent({
				timeout: 100,
				over: function () {
					var current = jQuery('.dropdown:eq(0)', this);
					current.slideDown(100);
				},
				out: function () {
					var current = jQuery('.dropdown:eq(0)', this);
					current.fadeOut(200);
				}
			});
		});
		
		jQuery('.dropdown a').hover(function () {
			jQuery(this).stop(true).animate({paddingLeft: '35px'}, {speed: 100, easing: 'easeOutBack'});
		}, function () {
			jQuery(this).stop(true).animate({paddingLeft: '0'}, {speed: 100, easing: 'easeOutBounce'});
		});
		
		pic1 = new Image(310, 672);
		pic1.src = "/kaching/img/dropdown.png"; 
		
		pic2 = new Image(4, 40);
		pic2.src = "/kaching/img/dropselectionleft.png"; 
		
		pic3 = new Image(394, 40);
		pic3.src = "/kaching/img/dropselectionright.png";
	});
</script>
