<?php

	ob_start('ob_gzhandler');

	include_once('./BDD/users.php');
	include_once('fct.php');
	session_start();

	/* #################################################################################################
						TRAITEMENTS PHP
	################################################################################################### */

	//  Si la personne est déjà loged on la redirige
	is_loged() && redirection('./accueil.php');

	// Définition d'un tableau d'erreurs qui servira à afficher les erreurs du formulaire
	$error = array();

	// Si on arrive sur la page par soumission de formulaire pour demander la connexion,
	if(isset($_POST['cxn'])){

		// On vérifie que les paramètres attendus via POST soient bien présents pour prévenir tout problème
		// Le die sera a remplacer par un email en production
		!verify_post_params(array(  
			array('nom' => 'cxn', 'excpected' => 'cxn'),
			array('nom' => 'ident', 'excpected' => null),
			array('nom' => 'pwd', 'excpected' => null),
		 )) && die('Erreur dans les paramètres POST attendues');

		// On vérifie que le couple ID / mdp existe en BDD. Sinon affichage des erreurs
		if(intval(UserExist($_POST['ident'], $_POST['pwd'])) > 0) {
			//Mise en session des éléments
			$_SESSION['ident'] = $_POST['ident'];
			redirection('./accueil.php');
		}else{
			$error = array('Le couple ID / MDP ne corresponds pas à un utilisateur de l\'application');
		}
		
	}

/*	
	La fonction verif Co était défini deux fois dans deux fichiers différents ! utilisateurs.php => Copie de funt.php ? La page est inutile et à supprimer. De plus elle n'a rien a faire dans le dossier BDD réservé aux fonction qui intérrogent la base de donnée.

	D'autre part tu envoie des parmètres à tes fonction mais tu ne t'en sert jamais tu reprends les valeurs directement dans POST (voir commentaire dans users.php)
	Les requêtes SQL sont a privilégier dans les pages dédiées du dossier BDD ca évite d'en avoir partout et de mieux se repérer.

	Les fichiers dans BDD relfete les tables de la DBB il faut les nommer du même nom que les tables sur lesquels les fonction agissent. Il ne faut pas créer de addUser.php mais un user.php dans lequel on va mettre toutes les fonctions 

	if ((isset($_POST['cxn'])) && $_POST['cxn'] === 'cxn') {
		verifco($_POST['ident'], $_POST['pwd']);
	}
*/

	/* #################################################################################################
									AFFICHAGES
	################################################################################################### */


	pageStart();
?>

	<?php !empty($error) && var_dump($error); ?>
	<div id="login-Page-101">
	    <div id="centered-bloc" class="col-md-4">
	        <h3 class="text-center">Connexion</h3>

	        <form  action="bibli.php" method="post">
	            
	            <div class="form-group">
	                <label for="login">Identifiant</label>
	                <input type="text"  class="form-control" name="ident" required="required" value="<?php echo isset($_POST['ident']) ? htmlentities(trim($_POST['ident'])) : '' ; ?>" maxlenght ='20'/>
	            </div>

	            <div class="form-group">
	                <label for="login">Mot de passe</label>
	                <input type="password"  class="form-control" name="pwd" required="required" value="<?php echo isset($_POST['pwd']) ? htmlentities(trim($_POST['pwd'])) : ''; ?>" maxlenght ='20' />
	            </div>

	            <div class="form-btn text-center">
	                <button type="submit" name="cxn" value= 'cxn' class="btn btn-primary">Login <i class="fas fa-arrow-right"></i></button>
	            </div>
	        </form>	
	    </div>
	</div>

<?php

pageEnd();

?>