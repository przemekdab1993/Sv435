<?php 

	session_start();
	session_unset();
	$alert = "<h2>Zostałeś wylogowany</h2>"; 
	$_SESSION['alert'] = $alert;
	
	header('Location: index.php');
	
?>