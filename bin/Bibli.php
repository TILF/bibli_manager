<?php

	ob_start('ob_gzhandler');

	include_once('bddacces.php');
	include_once('./BDD/utilisateurs.php');
	session_start();

	if ((isset($_POST['cxn'])) && $_POST['cxn'] === 'cxn') {
		
		verifco($_POST['ident'], $_POST['pwd']);
	}
?>

<title>Gestion bibliothèque</title>
<head>
	Gestion bibliothèque
</head>

<body>
	<div id="content">
		<div id="bloc_login">
			<form action="bibli.php" method="post">
				<div>
					<h2 id="t2" class="titre">Connexion</h2>
				</div>

				<div>
					<label>Identifiant</label>
					<input type="text"  class="form-control" name="ident" required="required" value="<?php if (isset($_POST['ident'])) echo htmlentities(trim($_POST['ident'])); ?>">
				</div>

				<div>
					<label>Mot de passe</label>
					<input type="password"  class="form-control" name="pwd" required="required" value="<?php if (isset($_POST['pwd'])) echo htmlentities(trim($_POST['pwd'])); ?>">
				</div>

				<div class="form-bloc">
					<input type="checkbox"  name="Rm"> Se souvenir de moi!
				</div>

				<div class="center form-bloc"> 
					<button type="submit" name="cxn" value= 'cxn' class="btn btn-success">Valider</button>
				</div>
			</form>
		</div>
	</div>
</body>

<footer></footer>