<?php

	ob_start('ob_gzhandler');
	session_start();

	include_once('bddacces.php');
	include_once('./fct.php');

	if (isset($_SESSION['ident'])) {
		
		$ident = $_SESSION['ident'];
	}

	else{
		header('Location: Bibli.php');
	}


	pageStart();

?>

<title>Accueil</title>
<h1>Acceuil</h1>

<body background="../images/accueillant.jpg">
	<form action="accueil.php" method="post"></form>
		<div>
			<h1>Rechercher un livre</h1>
			<h2>Par Titre:</h2>
				<input type="text" name="li">
			<h2>Par auteur:</h2>
				<input type="text" name="aut">
			<h2>Par référence:</h2>
				<input type="number" name="ref">
				<button name="bt1">Valider</button>
		</div>
	</form>

	<form action="accueil.php" method="post"></form>
		<div>
			<h1>Rechercher un adhérent</h1>
			<div>
				<h2>Par nom:</h2>
					<input type="text" name="adn">
			</div>
			<div>
				<h2>Par prénom:</h2>
					<input type="text" name="adp">
			</div>
			<div>
				<h2>Par numéro adhérent:</h2>
					<input type="number" name="adref">
					<button name="bt1">Valider</button>
			</div>
		</div>
	</form>
</body>
<footer>
	Contactez-nous !
</footer>

<?php pageEnd(); ?>