<?php

include_once('./bddacces.php');

/**
	 * Récupération de l'ensemble des données de tous les livres non réservés
	 * @return ARRAY Données extraites de la BDD
	 */
function getBooksFree(){
	$bd = bd_connect();
	$sql = "SELECT * FROM Livres WHERE Reference NOT IN ( SELECT Livres_fk FROM Emprunts_livres) ORDER BY Reference";
	$res = mysqli_query($bd , $sql) or bd_erreur($bd , $sql);;
	mysqli_close($bd);
	return $res;
}