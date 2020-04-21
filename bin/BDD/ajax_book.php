<?php 

	include_once('../bddacces.php');
	$bd = bd_connect();

	if($_POST['demand'] === 'byTitle'){
		
		$sql = "SELECT * FROM livres";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		$final = array();
		while($array= mysqli_fetch_assoc($res)){
			$final[] = $array['Titre'];
		}
		echo \json_encode($final);
	}else if($_POST['demand'] === 'fullInfos'){
		$sql = "SELECT * FROM livres WHERE Titre LIKE '" . mysqli_real_escape_string($bd , trim($_POST['pattern'])) . "'";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		$final = mysqli_fetch_array($res);
		echo \json_encode($final);
	}
	
	mysqli_close($bd);
?>