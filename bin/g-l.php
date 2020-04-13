<?php
	session_start();
?>

<title>Gestion livres</title>
<head>Gestion des livres</head>

<h2>Ajouter un livre</h2>

<div>
	Titre
	<input type="text" name="tl" required="required">
</div>
<div>
	Auteur
	<input type="text" name="au" required="required">
</div>
<div>
	Référence
	<input type="number" name="refe" required="required">
</div>
<div>
	Année parution
	<input type="number" name="ap" required="required">
</div>
<div>
	Emplacement
	<input type="text" name="emp" required="required">
</div>
<div>
	Etat
	<input type="text" name="et" required="required">
</div>
<div>
	<input type="radio" name="appart">Bibliothèque
	<input type="radio" name="appart">Médiathèque
</div>
<div>
	<input type="submit" name="val1">
</div>

<div>
	<button><a href ="accueil.php">Accueil</a></button>
</div>

<div>
	<a href="deco.php">Déconnexion</a>
</div>