<?php
include_once('../bddacces.php');

function myass4($ii , $hip){

	$bd = bd_connect();
	$ii = mysqli_real_escape_string($bd , $_POST['ii']);
	$ip = mysqli_real_escape_string($bd , $_POST['ip']);
	$hip = password_hash($ip, PASSWORD_BCRYPT);
	$sql = "INSERT INTO users (ident , pwd) VALUES ('$ii' , '$hip')";
	$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
	mysqli_close($bd);
}
?>