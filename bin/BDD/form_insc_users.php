<?php


include_once('addusers.php');
include_once('../bddacces.php');
include_once('../fct.php');

if ((isset($_POST['cxni'])) && (isset($_POST['ii'])) && (isset($_POST['ip']))) {
		$ii = $_POST['ii'];
		$ip = $_POST['ip'];
}

if(isset($_POST['cxni']) && $_POST['cxni'] === 'cxni'){
		myass4($_POST['ii'], $_POST['ip']);
		header('Location:form_insc_users.php');
}  

?>

<title>
	Inscription Utilisateurs
</title>

<head>
	Gestion Bibliothèque
		<link href=".../css/bootstrap.min.css" rel="stylesheet">
        <link href=".../css/fontawesome-5.13.0/css/all.min.css" rel="stylesheet">
        <link href=".../css/datatables.min.css" rel="stylesheet">
        <link href=".../css/main.css" rel="stylesheet">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
</head>

<body>
	<div id="content" class="row justify-content-center">
		<div id="bloc-login">
			<form action="form_insc_users.php" method="post" class="bloc-form col-md-8">
				<div>
					<h2>
						Inscription Utilisateurs
					</h2>
				</div>

				<div>
					<label>Identifiant</label>
					<input type="text"  class="form-control" name="ii" required="required" value="<?php if (isset($_POST['ident'])) echo htmlentities(trim($_POST['ident'])); ?>">
				</div>

				<div>
					<label>Mot de passe</label>
					<input type="password"  class="form-control" name="ip" required="required" value="<?php if (isset($_POST['ident'])) echo htmlentities(trim($_POST['ident'])); ?>">
				</div>

				<div class="center form-bloc"> 
					<button type="submit" name="cxni" value= 'cxni' class="btn btn-success">Valider</button>
				</div>
			</form>
		</div>

		<div>
			<button>Connexion</button>
		</div>

	</div>
</body>
