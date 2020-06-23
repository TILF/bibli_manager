<?php

include_once('./bddacces.php');

/**
	 * Récupération de l'ensemble des données de tous les livres
	 * @return ARRAY Données extraites de la BDD
	 */
	function get_allbooks(){

		$bd = bd_connect();
		$sql = "SELECT * FROM livres";
		$res = mysqli_query($bd , $sql) or bd_erreur($bd , $sql);;
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
		$res = mysqli_query($bd , $sql) or bd_erreur($bd , $sql);
		mysqli_close($bd);
		return $res;
	}

/**
	 * Récupération de livres selon le nom de l'auteur
	 * @return ARRAY Données extraites de la BDD
	 */
	function get_bookbyauteur($au){

		$bd = bd_connect();
		$au =  mysqli_real_escape_string($bd , $au);
		$sql = "SELECT * FROM livres WHERE  Auteur = '$au'";
		$res = mysqli_query($bd , $sql) or bd_erreur($bd , $sql);
		$book = mysqli_fetch_assoc($res);
		mysqli_close($bd);
		return $book;
	}

/**
	 * Récupération de livres selon le titre
	 * @return ARRAY Données extraites de la BDD
	 */
	function get_bookbytitre($tl){

		$bd = bd_connect();
		$tl = mysqli_real_escape_string($bd , $tl);
		$sql = "SELECT * FROM livres WHERE Titre = '$tl'";
		$res = mysqli_query($bd , $sql) or bd_erreur($bd , $sql);
		$book = mysqli_fetch_assoc($res);
		mysqli_close($bd);
		return $book;
	}

/**
	 * Récupération de livres selon la référence
	 * @return ARRAY Données extraites de la BDD
	 */
	function get_bookbyrefe($refe){

		$bd = bd_connect();
		$refe = mysqli_real_escape_string($bd , $refe);
		$sql = "SELECT * FROM livres WHERE Reference = '$refe'";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd , $sql);
		$book = mysqli_fetch_assoc($res);
		mysqli_close($bd);
		return $book;
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
		//die('ok');
		$bd = bd_connect();
		$refe = mysqli_real_escape_string($bd , $refe);
		$tl = mysqli_real_escape_string($bd , $tl);
		$au = mysqli_real_escape_string($bd , $au);
		$ap = mysqli_real_escape_string($bd , $ap);
		$emp = mysqli_real_escape_string($bd , $emp);
		$et = mysqli_real_escape_string($bd , $et);
		$exem = mysqli_real_escape_string($bd , $exem);
		$appart = mysqli_real_escape_string($bd , $appart);
		$sql = "INSERT INTO livres (Reference , Titre , Auteur , Annee_parution , Emplacement , Etat_actuel , Exemplaires , Bibli_media) 
				VALUES ('$refe' , '$tl' , '$au' , '$ap' , '$emp' , '$et' , '$exem' , '$appart')";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		mysqli_close($bd);
	}

/**
	 * Modification du nombre d'exemplaires
	 * @param [INT] $Exem 		[Exemplaires]
	 * @return ARRAY Données extraites de la BDD
	 */
	function updatebook($exem, $refe){

		$bd = bd_connect();
		$exem = mysqli_real_escape_string($bd , $exem);
		$refe = mysqli_real_escape_string($bd , $refe);
		$sql = "UPDATE livres
				SET  Exemplaires = '$exem'
				WHERE Reference = '$refe'";
		$res = mysqli_query($bd , $sql)  or bd_erreur($bd, $sql);
		mysqli_close($bd);
		return $res;
	}

/** Suppression d'un livre, recherche par titre **/
	function removebook($refe){

		$bd = bd_connect();
		$refe = mysqli_real_escape_string($bd , $refe);
		$sql = "DELETE FROM livres WHERE Reference = '$refe'";
		$res = mysqli_query($bd , $sql) or bd_erreur($bd , $sql);
		mysqli_close($bd);
	}
?>