<?php 

	include_once('../bddacces.php');
	$bd = bd_connect();


	$sql = "SELECT * FROM livres";
	$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
	$final = array();
	while($array= mysqli_fetch_assoc($res)){
		$final[] = $array['Reference'];
	}
	echo \json_encode($final);

	
	mysqli_close($bd);
?>