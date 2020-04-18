<?php
	include_once('./bddacces.php');

	// Idem tu passes des paramètres dans ta fonction que tu n'utilise pas et tu reprends $_POST. Il faut généraliser la fonction en ne prenant pas $_POST ici !
	// Donne des noms explicite a tes fonctions et à tes variables. Quand tu auras plusieurs 10aines de pages et qu'il faudra faire de la maintenance tu perdra beaucoup de temps a esseyer de comprendre ce que chacune fait
/*	function myAss4($ii , $hip){

		$bd = bd_connect();
		$ii = mysqli_real_escape_string($bd , $_POST['ii']);
		$ip = mysqli_real_escape_string($bd , $_POST['ip']);
		$hip = password_hash($ip, PASSWORD_BCRYPT);
		$sql = "INSERT INTO users (ident , pwd) VALUES ('$ii' , '$hip')";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		mysqli_close($bd);
	}*/

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