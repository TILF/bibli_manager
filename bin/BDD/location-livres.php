<?php

include_once('bddacces.php');

function reserver($date_d , $date_f , $id_livre , $id_adh){
	$bd = bd_connect();
	$date_d = mysqli_real_escape_string($bd , $date_d);
	$date_f = mysqli_real_escape_string($bd , $date_f);
	$id_livre = mysqli_real_escape_string($bd , $id_livre);
	$id_adh = mysqli_real_escape_string($bd , $id_adh);
	$sql = "INSERT INTO emprunts_livres (Date_debut , Date_fin , Livres_fk , Adherents_fk , Date_rendu) 
	VALUES ('$date_d' , '$date_f', '$id_livre' , '$id_adh' , NULL)";
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

function getreservationRetard(){
	$bd = bd_connect();
	$sql = "SELECT * FROM emprunts_livres WHERE Date_fin < NOW()";
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

function etat_livre(){
	$bd = bd_connect();
	$sql = "SELECT Etat_actuel FROM livres";
	$res = mysqli_query ($bd , $sql) or bd_erreur($bd , $sql);
	mysqli_close($bd);
	return $res;
}

function getReservationById($fkemprunts_livres){
	$bd = bd_connect();
	$fkemprunts_livres =  mysqli_real_escape_string($bd , $fkemprunts_livres);
	$sql = "SELECT
			Date_debut ,
			Date_fin , 
			Livres_fk ,
			Adherents_fk ,
			Date_rendu ,
			Etat_actuel
			FROM emprunts_livres 
				INNER JOIN livres
					ON emprunts_livres.Livres_fk = Livres.Reference
			WHERE Id_emprunt = " . intval($fkemprunts_livres);
	$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
	$liv = mysqli_fetch_assoc($res);
	mysqli_close($bd);
	return $liv;
}

function getreservationAccueil(){
	$bd = bd_connect();
	$sql = "SELECT 
	Id_emprunt , 
	Date_debut , 
	Date_fin , 
	Titre ,
	Reference ,
	Nom ,
	Prenom 
	FROM emprunts_livres 
			INNER JOIN livres 
				ON emprunts_livres.Livres_fk = Livres.Reference
			INNER JOIN adherents 
				ON emprunts_livres.Adherents_fk = adherents.Id
				ORDER BY Date_debut";
    $res = mysqli_query ($bd , $sql) or bd_erreur($bd , $sql);
	mysqli_close($bd);
	return $res;
}
?>