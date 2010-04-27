<?php
if (isset($paginator))
{
?>
<div>
<?php
	$paginator->options(array('url' => $this->passedArgs));
	
	/* Shows the page numbers */
	echo $paginator->numbers();
	
	/* Shows the next and previous links */
	// echo $paginator->prev('« Previous ', null, null, array('class' => 'disabled'));
	// echo $paginator->next(' Next »', null, null, array('class' => 'disabled'));
	
	/* prints X of Y, where X is current page and Y is number of pages */
	echo "<br />";
	echo $paginator->counter();
?></div>
<?php
}
?>