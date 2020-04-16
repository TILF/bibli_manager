<?php

	ob_start('ob_gzhandler');

	include_once('bddacces.php');
	include_once('fct.php');
	session_start();

	if ((isset($_POST['cxn'])) && $_POST['cxn'] === 'cxn') {
		
		verifco($_POST['ident'], $_POST['pwd']);
	}

	pageStart();
?>

<body background="../images/i-co.jpeg" class="img-responsive">
	<div class="bg"></div>
    <p class="py-5 text-center">
	<div id="content">
		<div id="bloc_login">
			<form action="bibli.php" method="post">
				<div>
					<h2 id="t2" class="titre">Connexion</h2>
				</div>

				<div id="form-group" class="col-xs-4">
					<label>Identifiant</label>
					<input type="text"  class="form-control" name="ident" required="required" value="<?php if (isset($_POST['ident'])) echo htmlentities(trim($_POST['ident'])); ?>">
				</div>

				<div id="form-group" class="col-xs-4">
					<label>Mot de passe</label>
					<input type="password"  class="form-control" name="pwd" required="required" value="<?php if (isset($_POST['pwd'])) echo htmlentities(trim($_POST['pwd'])); ?>">
				</div>

				<div class="col-xs-4" >
					<input type="checkbox"  name="Rm"> Se souvenir de moi!
				</div>

				<div class="col-xs-4"> 
					<button type="submit" name="cxn" value= 'cxn' class="btn btn-success">Valider</button>
				</div>
			</form>
		</div>
	</div>
</body>

<footer></footer>

<?php

pageEnd();

?>