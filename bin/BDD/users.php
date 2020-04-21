<?php
	include_once('./bddacces.php');

	function insertUsr($ident , $pwd){

		$bd = bd_connect();
		$ident = mysqli_real_escape_string($bd , $ident);
		$ip = mysqli_real_escape_string($bd , $pwd);
		$hip = md5($ip);
		$sql = "INSERT INTO users (ident , pwd) VALUES ('$ident' , '$hip')";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		mysqli_close($bd);
	}

	function UserExist($ident, $pwd){
		$bd  	= bd_connect();
		$ident  = mysqli_real_escape_string($bd , $ident);
		$pwd 	= mysqli_real_escape_string($bd , $pwd);
		$hip 	= md5($pwd);
		$sql 	= "SELECT COUNT(id) as exist FROM users WHERE ident =  '$ident' AND pwd = '$hip'";
		$res 	= mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		$nb 	= mysqli_fetch_assoc($res);
		mysqli_close($bd);
		return  $nb['exist'];
	}
?>