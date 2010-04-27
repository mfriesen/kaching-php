<?php
class DateHelper extends AppHelper {
		
	function stringToDate($dateString) {
		$keywords = preg_split('/\W+/', $dateString);
		$size = sizeof($keywords);
		
		if ($size <= 1)
			return null;
			
		if ($size == 3) {
			return mktime(0, 0, 0, $keywords[1], $keywords[2], $keywords[0]);
		}
		
    	return mktime($keywords[3], $keywords[4], 0, $keywords[1], $keywords[2], $keywords[0]);
	}
	
	function formatDate($dateString, $pattern) {
		
		if (strlen($dateString) == 0) {
			return "";
		}
		
		$date = $this->stringToDate($dateString);
		return date($pattern, $date);
	}
}
?>