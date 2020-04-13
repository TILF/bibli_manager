<?php
	session_start();
?>

<title>Accueil</title>
<head>Gestion bibliothèque</head>

<div>
	<h1>Rechercher un livre</h1>
		<h2>Par Titre:</h2>
		<input type="text" name="li">
		<h2>Par auteur</h2>
		<input type="text" name="aut">
		<h2>Par référence:</h2>
		<input type="number" name="ref">
		<button name="bt1">Valider</button>
</div>

<div>
	<h1>Rechercher un adhérent</h1>
		<h2>Par nom:</h2>
		<input type="text" name="adn">
		<h2>Par prénom</h2>
		<input type="text" name="adp">
		<h2>Par numéro adhérent:</h2>
		<input type="number" name="adref">
		<button name="bt1">Valider</button>
</div>

<div>
	<button> <a href = "g-l.php">Gérer les livres</a></button>
</div>

<div>
	<button> <a href = "insc-adh.php">Inscription adhérents</a></button>
</div>
<footer>
	Contactez-nous !
	<a href="deco.php">Déconnexion</a>
</footer>