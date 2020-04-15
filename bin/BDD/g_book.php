<?php

include_once('./bddacces.php');

	function get_allbooks(){

		$bd = bd_connect();
		$sql = "SELECT * FROM livres";
		$res = mysqli_query($bd , $sql) or bd_erreur($bd , $sql);
		mysqli_close($bd);
		return $res;
	}

	function get_bookp(){

		$bd = bd_connect();
		$sql = "SELECT * FROM livres WHERE Exemplaires IS NOT NULL";
		$res = mysqli_query($bd , $sql) or mysqli_error($bd , $sql);
		mysqli_close($bd);
		return $res;
	}

	function get_bookbyauteur($au){

		$bd = bd_connect();
		$sql = "SELECT * FROM livres WHERE  Auteur = '$au'";
		$res = mysqli_query($bd , $sql) or mysqli_error($bd , $sql);
		mysqli_close($bd);
		return $res;
	}

	function get_bookbytitre($tl){

		$bd = bd_connect();
		$sql = "SELECT * FROM livre WHERE Titre = '$tl'";
		$res = mysqli_query($bd , $sql) or mysqli_error($bd , $sql);
		mysqli_close($bd);
		return $res;
	}

	function addbook(){

		$bd = bd_connect();
		$sql = "INSERT INTO livres (Reference , Titre , Auteur , Annee_parution , Emplacement , Etat_actuel , Exemplaires , Bibli_media) VALUES ('$refe' , '$tl' , '$au' , '$ap' , '$emp' , '$et' , '$exem' , '$appart')";
		$res = mysqli_query($bd , $sql) or mysqli_error($bd, $sql);
		mysqli_close($bd);
	}

	function updatebook(){

		$bd = bd_connect();
		$sql = "UPDATE livres
				SET  Exemplaires = '$exem'
				WHERE Reference = '$refe'";
		$res = mysqli_query($bd , $sql);
		mysqli_close($bd);
		return $res;
	}

	function removebook(){

		$bd = bd_connect();
		$sql = "DELETE FROM livres WHERE Titre = '$tl'";
		$res = mysqli_query($bd , $sql) or mysqli_error($bd , $sql);
		mysqli_close($bd);
	}
?>