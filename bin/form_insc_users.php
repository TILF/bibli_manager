<?php

	ob_start('ob_gzhandler');

	include_once('BDD/users.php');
	include_once('fct.php');
	session_start();

/*if ((isset($_POST['cxni'])) && (isset($_POST['ii'])) && (isset($_POST['ip']))) {
		$ii = $_POST['ii'];
		$ip = $_POST['ip'];
}

if(isset($_POST['cxni']) && $_POST['cxni'] === 'cxni'){
		myass4($_POST['ii'], $_POST['ip']);
		header('Location:form_insc_users.php');
}  */

	

	/* #################################################################################################
						TRAITEMENTS PHP
	################################################################################################### */

	//  Si la personne est déjà loged on la redirige
	is_loged() && redirection('./accueil.php');

	// Définition d'un tableau d'erreurs qui servira à afficher les erreurs du formulaire
	$error = array();

	// Si on arrive sur la page par soumission de formulaire pour demande d'inscription,
	if(isset($_POST['cxn'])){

		// On vérifie que les paramètres attendus via POST soient bien présents pour prévenir tout problème
		// Le die sera a remplacer par un email en production
		!verify_post_params(array(  
			array('nom' => 'cxn', 'excpected' => 'cxn'),
			array('nom' => 'ident', 'excpected' => null),
			array('nom' => 'pwd', 'excpected' => null),
		 )) && die('Erreur dans les paramètres POST attendues');

		// ---- TODO : Devoir maison, véririfer que l'id nexiste pas déjà avant de le créer
		// 
		// Insertion et redirection
		insertUsr($_POST['ident'], $_POST['pwd']);
		redirection('./Bibli.php');
	}


	/* #################################################################################################
									AFFICHAGES
	################################################################################################### */

	pageStart();

?>

<!-- Ne pas réécrire a toutes les pages, il faut utiliser la fonction pageStart et pageEnd en fonction-->
<!-- <title>
	Inscription Utilisateurs
</title>

<head>
	Gestion Bibliothèque
		<link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href=".../css/fontawesome-5.13.0/css/all.min.css" rel="stylesheet">
        <link href=".../css/datatables.min.css" rel="stylesheet">
        <link href=".../css/main.css" rel="stylesheet">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
</head> [...]  -->

<!-- <body>
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
 -->

 	<div id="login-Page-101">
	    <div id="centered-bloc" class="col-md-4">
	        <h3 class="text-center">Inscription</h3>

	        <form  action="form_insc_users.php" method="post">
	            
	            <div class="form-group">
	                <label for="login">Identifiant</label>
	                <input type="text"  class="form-control" name="ident" required="required" value="<?php echo isset($_POST['ident']) ? htmlentities(trim($_POST['ident'])) : '' ; ?>">
	            </div>

	            <div class="form-group">
	                <label for="login">Mot de passe</label>
	                <input type="password"  class="form-control" name="pwd" required="required" value="<?php echo isset($_POST['pwd']) ? htmlentities(trim($_POST['pwd'])) : ''; ?>" />
	            </div>

	            <div class="form-btn text-center">
	                <button type="submit" name="cxn" value= 'cxn' class="btn btn-success">S'inscrire <i class="fas fa-arrow-right"></i></button>
	            </div>
	        </form>	
	    </div>
	</div>

<?php

pageEnd();

?>