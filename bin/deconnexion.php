<?php
	include_once('fct.php');

	isset($_SESSION) && session_unset() && session_destroy();	

	$cookieParams = session_get_cookie_params();
	setcookie(session_name(), 
		'', 
		time() - 86400,
     	$cookieParams['path'], 
     	$cookieParams['domain'],
     	$cookieParams['secure'],
     	$cookieParams['httponly']
	);

	redirection("Bibli.php");

?>