<?php

include_once('bddacces.php');

function reserver($date_d , $date_f , $id_livre , $id_adh){
	
	$bd = bd_connect();
	$date_d = mysqli_real_escape_string($bd , $date_d);
	$date_f = mysqli_real_escape_string($bd , $date_f);
	$id_livre = mysqli_real_escape_string($bd , $id_livre);
	$id_adh = mysqli_real_escape_string($bd , $id_adh);
	$sql = "INSERT INTO emprunts_livres (Date_debut , Date_fin , Livres_fk , Adherents_fk) 
	VALUES ('$date_d' , '$date_f', '$id_livre' , '$id_adh')";
	$res = mysqli_query ($bd , $sql) or bd_erreur($bd , $sql);
	mysqli_close($bd);
}

function reservation_courante(){

	$bd = bd_connect();
	$sql = "SELECT * FROM emprunts_livres WHERE Date_rendu IS NULL"; 
	$res = mysqli_query ($bd , $sql) or bd_erreur($bd , $sql);
	mysqli_close($bd);
	return $res;
}

function reservation_retard(){

	$bd = bd_connect();
	$sql = "SELECT * FROM emprunts_livres WHERE Date_rendu IS NULL AND CURRDATE() > date_fin";
	$res = mysqli_query ($bd , $sql) or bd_erreur($bd , $sql);
	mysqli_close($bd);
	return $res;
}

function update_location(){

	$bd = bd_connect();
	$date_r = mysqli_real_escape_string($bd , $date_r);
	$etat = mysqli_real_escape_string($bd , $etat);
	$sql = "UPDATE emprunts_livres
			SET Date_rendu = $date_r
				Etat = $etat
			WHERE Id_emprunts = fkemprunts_livres";
	$res = mysqli_query ($bd , $sql) or bd_erreur($bd , $sql);
	mysqli_close($bd);
}

function historique(){

	$bd = bd_connect();
	$sql = "SELECT * FROM emprunts_livres WHERE Date_rendu IS NOT NULL
			ORDER BY Date_rendu DESC";
	$res = mysqli_query ($bd , $sql) or bd_erreur($bd , $sql);
	mysqli_close($bd);
	return $res;
}
?>