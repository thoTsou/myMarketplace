<?php
session_start();
?>

<?php
			
	$_SESSION = array();
	session_destroy();
	header("Location: frontPage.html");
			
?>