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

	if ((isset($_POST['bt1'])) && (isset($_POST['tl'])) && $_POST['bt1'] === 'bt1') {
		
		get_bookbytitre($_POST['tl']);
		header('Location: accueil.php');
	}

	elseif ((isset($_POST['bt1'])) && (isset($_POST['au'])) && $_POST['bt1'] === 'bt1') {
		get_bookbyauteur($_POST['au']);
		header('Location: accueil.php');
	}

	elseif ((isset($_POST['bt1'])) && (isset($_POST['refe'])) && $_POST['bt1'] === 'bt1') {
		get_bookbyrefe($_POST['refe']);
		header('Location: accueil.php');
	}

	if ((isset($_POST['bt2'])) && (isset($_POST['nom'])) && $_POST['bt2'] === 'bt2') {
		
		get_adherentbynom($_POST['nom']);
		header('Location: accueil.php');
	}

	elseif ((isset($_POST['bt2'])) && (isset($_POST['pnom'])) && $_POST['bt2'] === 'bt2') {
		get_adherentbypnom($_POST['pnom']);
		header('Location: accueil.php');
	}

	elseif ((isset($_POST['bt2'])) && (isset($_POST['id'])) && $_POST['bt2'] === 'bt2') {
		getAdherentById($_POST['id']);
		header('Location: accueil.php');
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
				<input type="text" name="tl">
			<h2>Par auteur:</h2>
				<input type="text" name="au">
			<h2>Par référence:</h2>
				<input type="number" name="refe">
				<button name="bt1" type="submit" value="bt1">Valider</button>
		</div>
	</form>

	<form action="accueil.php" method="post"></form>
		<div>
			<h1>Rechercher un adhérent</h1>
			<div>
				<h2>Par nom:</h2>
					<input type="text" name="nom">
			</div>
			<div>
				<h2>Par prénom:</h2>
					<input type="text" name="pnom">
			</div>
			<div>
				<h2>Par numéro adhérent:</h2>
					<input type="number" name="id">
					<button type="submit" name="bt2" value="bt2">Valider</button>
			</div>
		</div>
	</form>
</body>
<footer>
	
</footer>

<?php pageEnd(); ?>