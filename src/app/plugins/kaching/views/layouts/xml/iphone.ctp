<?php //echo $xml->header(array('version'=>'1.1')); ?>

<?php 
if (!empty($this->data)) {
	echo $xml->serialize($this->data, array("root"=>"kaching"));
}
?>

<?php 
if (isset($error)) {
	echo "<kaching><error>$error</error></kaching>";
} 
?>

<?php 
if (isset($errors)) {
	
	echo "<kaching>";
	
	foreach ($errors as $key => $error) {
		echo "<error><field>$key</field><message>$error</message></error>";
	} 

	echo "</kaching>";
}
?>