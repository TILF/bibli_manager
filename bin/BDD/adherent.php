<?php
	include_once('./bddacces.php');

	/**
	 * Récupération de l'ensemble des données de tous les adhérents encore Actifs
	 * @return ARRAY Données extraites de la BDD
	 */
	function getAllAdherents(){

		$bd = bd_connect();
		$sql = "SELECT * FROM adherents WHERE dateFin IS NULL";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		mysqli_close($bd);
		return $res;
	}

	/**
	 * Récupération des information d'un adhérent en fonction de son ID
	 * @param  [INT] 	$fkAdherent [Id le l'adhérent]
	 * @return [ARRAY]              [Tableau associatif des données de l'adhérent]
	 */
	function getAdherentById($fkAdherent){

		$bd = bd_connect();
		$fkAdherent =  mysqli_real_escape_string($bd , $fkAdherent);
		$sql = "SELECT * FROM adherents WHERE Id = " . intval($fkAdherent);
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		$adh = mysqli_fetch_assoc($res);
		mysqli_close($bd);
		return $adh;
	}


	/**
	 * Insertion d'un nouvel adhérent
	 * @param  [STR] $nom    [Nom de l'adhérent]
	 * @param  [STR] $prenom [Prénom de l'adhérent]
	 * @param  [INT] $age    [âge de l'adhérent]
	 * @param  [INT] $tel    [Téléphone de l'adhérent]
	 * @param  [STR] $nrue   [Numéro de rue]
	 * @param  [INT] $zcode  [Code postal]
	 * @param  [STR] $vi     [Ville]
	 */
	function insertAdherent($nom, $prenom, $age, $tel, $nrue, $zcode, $vi){
		$bd = bd_connect();
		$nom =  mysqli_real_escape_string($bd , $nom);
		$pnom =  mysqli_real_escape_string($bd , $pnom);
		$age =  mysqli_real_escape_string($bd , $age);
		$tel =  mysqli_real_escape_string($bd , $tel);
		$nrue =  mysqli_real_escape_string($bd , $nrue);
		$zcode =  mysqli_real_escape_string($bd , $zcode);
		$vi =  mysqli_real_escape_string($bd , $vi);
		$sql = "INSERT INTO adherents (Nom,Prenom,Age,Adresse,Telephone,Cotisation,dateFin,Ville, CP)
				 VALUES ('$nom', '$prenom', $age, '$nrue', '$tel', 'Oui', NULL, '$vi',  $zcode) ";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		mysqli_close($bd);
	}

	/**
	 * Mise à jour des données d'un adhérent
	 * @param  [STR] $nom    		[Nom de l'adhérent]
	 * @param  [STR] $prenom 		[Prénom de l'adhérent]
	 * @param  [INT] $age    		[âge de l'adhérent]
	 * @param  [INT] $tel    		[Téléphone de l'adhérent]
	 * @param  [STR] $nrue   		[Numéro de rue]
	 * @param  [INT] $zcode  		[Code postal]
	 * @param  [STR] $vi     		[Ville]
	 * @param  [INT] $fkAdhérent 	[Id de l'adhérent à modifier]
	 */
	function updateAdherent($nom, $pnom, $age, $tel, $nrue, $zcode, $vi, $fkAdhérent){
		$bd = bd_connect();
		$nom =  mysqli_real_escape_string($bd , $nom);
		$pnom =  mysqli_real_escape_string($bd , $pnom);
		$age =  mysqli_real_escape_string($bd , $age);
		$tel =  mysqli_real_escape_string($bd , $tel);
		$nrue =  mysqli_real_escape_string($bd , $nrue);
		$zcode =  mysqli_real_escape_string($bd , $zcode);
		$vi =  mysqli_real_escape_string($bd , $vi);
		$fkAdhérent =  mysqli_real_escape_string($bd , $fkAdhérent);
		$sql  ="UPDATE adherents 
				SET Nom = '$nom',
				 Prenom = '$prenom',
				 Age = '$age',
				 Telephone = '$tel',
				 Adresse = '$nrue',
				 CP = '$zcode',
				 Ville = '$vi'
				WHERE Id = $fkAdhérent";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		mysqli_close($bd);
	}

	/**
	 * Supression d'un adhérent par ajour d'une date de fin à la relation
	 * @param  [STR] $date       	[Date de suppression]
	 * @param  [INT] $fkAdhérent 	[Id de l'adhérent à supprimer]
	 */
	function deleteAdherent($date, $fkAdhérent){
		$bd = bd_connect();
		$date =  mysqli_real_escape_string($bd , $date);
		$fkAdhérent =  mysqli_real_escape_string($bd , $fkAdhérent);
		$sql = "UPDATE adherents SET dateFin = '$date'
				WHERE Id = $fkAdhérent";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		mysqli_close($bd);
	}

/**
	 * Récupération de d'adhérents selon le prénom
	 * @return ARRAY Données extraites de la BDD
	 */
	function get_adherentbypnom($pnom){
		$bd = bd_connect();
		$pnom =  mysqli_real_escape_string($pnom , $au);
		$sql = "SELECT * FROM adherents WHERE Prenom = '$pnom'";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		mysqli_close($bd);
		return $res;
	}

/**
	 * Récupération d'adhérents selon le nom
	 * @return ARRAY Données extraites de la BDD
	 */
	function get_adherentbynom($nom){
		$bd = bd_connect();
		$nom =  mysqli_real_escape_string($bd , $nom);
		$sql = "SELECT * FROM adherents WHERE Nom = '$nom'";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		mysqli_close($bd);
		return $res;
	}
?>