<?php
class OrderUtilHelper extends AppHelper {
		
	function getOrderStatusMessages() {
		return array(0=>"Incomplete", 1=>"Completed", 2=>"Paid and Incomplete", 3=>"Refund", 99=>"Cancelled");
	}
	
	function getOrderStatusColours() {
		return array(0=>"black", 1=>"blue", 2=>"green", 3=>"purple", 99=>"red");
	}
}
?>