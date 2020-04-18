<?php


// A delete
include_once('./bddacces.php');

function myass(){
	if ((isset($_POST['ident'])) && (isset($_POST['pwd']))) {
		$ident = $_POST['ident'];
		$pwd = $_POST['pwd'];
	}
}

function connexion(){

	if (!isset($_SESSION['ident'])) {
		header("location : Bibli.php");
		exit();
	}
}

function is_loged(){

    return isset($_SESSION['ident']) ? true : false;
}

function verifco($ident , $pwd){

	if ((isset($_POST['ident'])) && (isset($_POST['pwd']))) {
		$ident = $_POST['ident'];
		$pwd = $_POST['pwd'];
	}

	$bd = bd_connect();
	$sql = "SELECT * FROM users WHERE ident = '$ident'";
	$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
	$num_row = mysqli_num_rows($res);
	$row = mysqli_fetch_array($res);

	if ($num_row >= 1) {

		if (password_verify($pwd, $row['pwd'])) {
			
			$_SESSION['ident'] = $row['ident'];
			header('Location: accueil.php');
		}
		
	}
	else{
		echo "false";
	}
}
?>