<?php

function reserver(){
	
	$bd = bd_connect():
	$sql = "INSERT INTO emprunts_livres (Date_debut , Date_fin , Livres_fk , Adherents_fk , Date_rendu , Etat , Rendu) 
	VALUES($date_d , $date_f , (
	SELECT Reference FROM Livres WHERE Titre = $livre ),
	(SELECT Id FROM Adherents WHERE Nom = $nom),
	$date_r , $etat , $rendu)";
	$res = mysqli_query ($bd , $sql) or mysqli_error($bd , $sql);
	mysqli_close($bd);
}

function reservation_courante(){

	$bd = bd_connect();
	$sql = "SELECT * FROM emprunts_livres WHERE Rendu IS NULL"; 
	$res = mysqli_query ($bd , $sql) or mysqli_error($bd , $sql);
	mysqli_close($bd);
	return $res;
}

function reservation_retard(){

	$bd = bd_connect();
	$sql = "SELECT * FROM emprunts_livres WHERE Date_rendu IS NULL AND Rendu IS NULL";
	$res = mysqli_query ($bd , $sql) or mysqli_error($bd , $sql);
	mysqli_close($bd);
	return $res;
}

function update_location(){

	$bd = bd_connect();
	$sql = "UPDATE emprunts_livres
			SET Date_fin = $date_f
				Date_rendu = $date_r
				Etat = $etat
				Rendu = $rendu
			WHERE (SELECT Reference FROM livres WHERE Titre = $livre)";
	$res = mysqli_query ($bd , $sql) or mysqli_error($bd , $sql);
	mysqli_close($bd);
}

function historique(){

	$bd = bd_connect();
	$sql = "SELECT * FROM emprunts_livres WHERE Date_fin IS NOT NULL AND Date_rendu IS NOT NULL
			ORDER BY Date_rendu DESC";
	$res = mysqli_query ($bd , $sql) or mysqli_error($bd , $sql);
	mysqli_close($bd);
	return $res;
}
?>