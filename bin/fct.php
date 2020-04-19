<?php

function connexion(){

	if (!isset($_SESSION['ident'])) {
		header("location : Bibli.php");
		exit();
	}
}


function myass(){
	if ((isset($_POST['ident'])) && (isset($_POST['pwd']))) {
		$ident = $_POST['ident'];
		$pwd = $_POST['pwd'];
	}
}


/**
 * Force la redirection vers une page spécifique
 * @param  [SRT] $page  Path vers le ficher php
 */
function redirection($page){
  header('Location:'.$page);
}

/**
 * Vérification de l'état de connexion de la personne
 * @return boolean  Vrai si un utilisateur est déjà connexté, Faux sinon
 */
function is_loged(){
    return isset($_SESSION['ident']) ? true : false;
}

/**
 * Vérifie que les données POST shouaitées soint bien présentes.
 * 
 * @param  ARRAY  $array Tableau contenant les données à checker et leur valeur attendue si besoin. Forme : array( array('nom' => nom du POST, 'excpected' => Valeur attendue ou null si pas de vérif), ...)
 * @return  boolean Vrai si tout est OK ,faux sinon
 */
function verify_post_params($array){

  foreach($array as $postToCheck){
    if(!$_POST[$postToCheck['nom']] || ($postToCheck['excpected'] !== null && $_POST[$postToCheck['nom']] != $postToCheck['excpected'])){
      return false;
    }
    return true;
  }

} 



/*###########################################################################################################
                                      FONCTION D'AFFICHAGE DES PAGES
#############################################################################################################*/

function pageStart(){
  echo  '<!DOCTYPE html>',
    '<html lang="fr">',

      '<head>',
       '<meta charset="utf-8">',
       ' <meta http-equiv="X-UA-Compatible" content="IE=edge">',

       '<title>Bibli Manager</title>',

        '<link href="../css/bootstrap.min.css" rel="stylesheet">',
        '<link href="../css/fontawesome-5.13.0/css/all.min.css" rel="stylesheet">',
        '<link href="../css/datatables.min.css" rel="stylesheet">',
        '<link href="../css/main.css" rel="stylesheet">',
        '<meta name="viewport" content="width-device-width, initial-scale=1.0">',


        '<script src="../js/jquery-3.5.0.min.js"></script>',
        '<script src="../js/bootstrap.min.js"></script>',
         '<script src="../js/datatables.min.js"></script>',

      '</head>',


      '<body>',


        '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">',
         ' <a class="navbar-brand" href="#">Book Manager</a>',
          '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">',
              '<span class="navbar-toggler-icon"></span>',
          '</button>',

         ' <div class="collapse navbar-collapse" id="navbarSupportedContent">',
              '<ul class="navbar-nav mr-auto">',
                 ' <li class="nav-item active">',
                   ' <a class="nav-link" href="accueil.php">Acceuil <span class="sr-only">(current)</span></a>',
                  '</li>',
                  '<li class="nav-item">',
                    '<a class="nav-link" href="./g-l.php">Livres</a>',
                  '</li>',
                  '<li class="nav-item">',
                    '<a class="nav-link" href="./insc-adh">Adhérents</a>',
                  '</li>',
                  '<li class="nav-item dropdown">',
                  '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">',
                   'Autre',
                 ' </a>',
                  '<div class="dropdown-menu" aria-labelledby="navbarDropdown">',
                    '<a class="dropdown-item" href="#">Voir les adhérents</a>',
                    '<a class="dropdown-item" href="#">Another action</a>',
                    '<div class="dropdown-divider"></div>',
                    '<a class="dropdown-item" href="#">Something else here</a>',
                  '</div>',
                  '</li>',
                 ' <li class="nav-item">',
                    '<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>',
                 ' </li>',
              '</ul>',
              
               
              '<div class="form-inline my-2 my-lg-0">',
                    '<a class="btn btn-outline-success my-2 my-sm-0" type="submit" href="' . ( isset($_SESSION['ident']) ? 'deconnexion.php' : 'Bibli.php' ) .'">
                       '. (isset($_SESSION['ident']) ? 'LogOut' : 'Login') .'
                    </a>',
              '</div> ',
                           
          '</div>',
        '</nav>',

        '<div id="contentPage">';
}

function pageEnd(){
    echo '</div>',
        '</body>',
  '</html>';
}

?>