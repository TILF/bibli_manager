<?php

function connexion(){

	if (!isset($_SESSION['ident'])) {
		header("location : Bibli.php");
		exit();
	}
}

function is_loged(){

    return isset($_SESSION['ident']) ? true : false;
}

function myass(){
	if ((isset($_POST['ident'])) && (isset($_POST['pwd']))) {
		$ident = $_POST['ident'];
		$pwd = $_POST['pwd'];
	}
}

function verifco($ident , $pwd){

  if ((isset($_POST['ident'])) && (isset($_POST['pwd']))) {
    $ident = $_POST['ident'];
    $pwd = $_POST['pwd'];
  }

  $bd = bd_connect();
  $sql = "SELECT * FROM users WHERE ident = '$ident'";
  $res = mysqli_query($bd, $sql) or bd_erreur($bd, $sql);
  $num_row = mysqli_num_rows($res);
  $row = mysqli_fetch_array($res);

  if ($num_row >= 1) {

    if (password_verify($pwd, $row['pwd'])) {
      
      $_SESSION['ident'] = $row['ident'];
      header('Location: accueil.php');
    }
    
  }
  else{
    echo "false";
    header('Location: Bibli.php');
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
                   '<a class="btn btn-outline-success my-2 my-sm-0" type="submit" href="#">Delavoux</a>',
              '</div> ',
                           
          '</div>',
        '</nav>';
}

function pageEnd(){
    echo
        '</body>',
  '</html>';
}

?>