<?php

include_once('./bddacces.php');

/**
	 * Récupération de l'ensemble des données de tous les livres
	 * @return ARRAY Données extraites de la BDD
	 */
	function get_allbooks(){

		$bd = bd_connect();
		$sql = "SELECT * FROM livres";
		$res = mysqli_query($bd , $sql) or bd_erreur($bd , $sql);
		mysqli_close($bd);
		return $res;
	}

/**
	 * Récupération de l'ensemble des données de tous les livres avec des exmplaires, donc non réservés
	 * @return ARRAY Données extraites de la BDD
	 */
	function get_bookp(){


		$bd = bd_connect();
		$sql = "SELECT * FROM livres WHERE Exemplaires IS NOT NULL";
		$res = mysqli_query($bd , $sql) or mysqli_error($bd , $sql);
		mysqli_close($bd);
		return $res;
	}

/**
	 * Récupération de livres selon le nom de l'auteur
	 * @return ARRAY Données extraites de la BDD
	 */
	function get_bookbyauteur($au){

		$bd = bd_connect();
		$sql = "SELECT * FROM livres WHERE  Auteur = '$au'";
		$res = mysqli_query($bd , $sql) or mysqli_error($bd , $sql);
		mysqli_close($bd);
		return $res;
	}

/**
	 * Récupération de livres selon le titre
	 * @return ARRAY Données extraites de la BDD
	 */
	function get_bookbytitre($tl){

		$bd = bd_connect();
		$sql = "SELECT * FROM livre WHERE Titre = '$tl'";
		$res = mysqli_query($bd , $sql) or mysqli_error($bd , $sql);
		mysqli_close($bd);
		return $res;
	}

/**
	 * Insertion d'un nouveau livre
	 * @param  [INT] $refe  	[Reference]
	 * @param  [STR] $tl 		[Titre]
	 * @param  [STR] $au    	[Auteur]
	 * @param  [STR] $ap    	[Annee_parution]
	 * @param  [STR] $emp   	[Emplacement]
	 * @param  [STR] $et  		[Etat_actuel]
	 * @param  [INT] $exem  	[Exemplaires]
	 * @param  [STR] $appart    [Appartenance]
	 */
	function addbook($refe , $tl , $au , $ap , $emp , $et , $exem , $appart){

		$bd = bd_connect();
		$sql = "INSERT INTO livres (Reference , Titre , Auteur , Annee_parution , Emplacement , Etat_actuel , Exemplaires , Bibli_media) VALUES ('$refe' , '$tl' , '$au' , '$ap' , '$emp' , '$et' , '$exem' , '$appart')";
		$res = mysqli_query($bd , $sql) or mysqli_error($bd, $sql);
		mysqli_close($bd);
	}

/**
	 * Modification du nombre d'exemplaires
	 * @param [INT] $Exem 		[Exemplaires]
	 * @return ARRAY Données extraites de la BDD
	 */
	function updatebook($exem){

		$bd = bd_connect();
		$sql = "UPDATE livres
				SET  Exemplaires = '$exem'
				WHERE Reference = '$refe'";
		$res = mysqli_query($bd , $sql);
		mysqli_close($bd);
		return $res;
	}

/** Suppression d'un livre, recherche par titre **/
	function removebook(){

		$bd = bd_connect();
		$sql = "DELETE FROM livres WHERE Titre = '$tl'";
		$res = mysqli_query($bd , $sql) or mysqli_error($bd , $sql);
		mysqli_close($bd);
	}
?>