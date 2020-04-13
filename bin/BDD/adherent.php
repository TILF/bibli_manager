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

	function getAdherentById($fkAdherent){

		$bd = bd_connect();
		$sql = "SELECT * FROM adherents WHERE Id = " . intval($fkAdherent);
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		$adh = mysqli_fetch_assoc($res);
		mysqli_close($bd);
		return $adh;
	}


	function insertAdherent($nom, $prenom, $age, $tel, $nrue, $zcode, $vi){
		$bd = bd_connect();
		$sql = "INSERT INTO adherents (Nom,Prenom,Age,Adresse,Telephone,Cotisation,dateFin,Ville, CP)
				 VALUES ('$nom', '$prenom', $age, '$nrue', '$tel', 'Oui', NULL, '$vi',  $zcode) ";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		mysqli_close($bd);
	}

	function updateAdherent($nom, $prenom, $age, $tel, $nrue, $zcode, $vi, $fkAdhérent){
		$bd = bd_connect();
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

	function deleteAdherent($date, $fkAdhérent){
		$bd = bd_connect();
		$sql = "UPDATE adherents SET dateFin = '$date'
				WHERE Id = $fkAdhérent";
		$res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
		mysqli_close($bd);
	}
?>