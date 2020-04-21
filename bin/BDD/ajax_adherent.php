<?php 

	include_once('../bddacces.php');
	$bd = bd_connect();

	if($_POST['demand'] === 'byName'){
		
		$sql = "SELECT * FROM adherents";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		$final = array();
		while($array= mysqli_fetch_assoc($res)){
			$final[] = $array['Nom'] . ' ' . $array['Prenom'];
		}
		echo \json_encode($final);
	}else if($_POST['demand'] === 'fullInfos'){
		$sql = "SELECT * FROM adherents WHERE CONCAT(Nom, ' ' , Prenom) LIKE '" . mysqli_real_escape_string($bd , trim($_POST['pattern'])) . "'";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		$final = mysqli_fetch_array($res);
		echo \json_encode($final);
	}
	
	mysqli_close($bd);
?>