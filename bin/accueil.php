<?php

	ob_start('ob_gzhandler');
	session_start();

	include_once('bddacces.php');
	include_once('./fct.php');
	include_once('./BDD/g_book.php');
	include_once('./BDD/adherent.php');

	if (isset($_SESSION['ident'])) {
		$ident = $_SESSION['ident'];
	}
	else{
		header('Location: Bibli.php');
	}
	pageStart();

?>
<div id="Accueillant">
	A venir
</div>
<title>Accueil</title>
<h1>Acceuil</h1>

<?php pageEnd(); ?>