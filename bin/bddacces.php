<?php
// Informations d'identification
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'bibli');
 

/** 
 *  Ouverture de la connexion à la base de données
 *
 *  @return objet   connecteur à la base de données
 */
function bd_connect() {
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($conn !== FALSE) {
        //mysqli_set_charset() définit le jeu de caractères par défaut à utiliser lors de l'envoi
        //de données depuis et vers le serveur de base de données.
        mysqli_set_charset($conn, 'utf8') 
        or bd_erreurExit('<h4>Erreur lors du chargement du jeu de caractères utf8</h4>');
        return $conn;     // ===> Sortie connexion OK
    }
    // Erreur de connexion
    // Collecte des informations facilitant le debugage
    $msg = '<h4>Erreur de connexion base MySQL</h4>'
            .'<div style="margin: 20px auto; width: 350px;">'
            .'BD_SERVER : '. DB_SERVER
            .'<br>BS_USER : '. DB_USERNAME
            .'<br>BS_PASS : '. DB_PASSWORD
            .'<br>BS_DB : '. DB_NAME
            .'<p>Erreur MySQL numéro : '.mysqli_connect_errno()
            .'<br>'.htmlentities(mysqli_connect_error(), ENT_QUOTES, 'ISO-8859-1')  
            //appel de htmlentities() pour que les éventuels accents s'affiche correctement
            .'</div>';
    bd_erreurExit($msg);
}

//____________________________________________________________________________
/**
 * Arrêt du script si erreur base de données 
 *
 * Affichage d'un message d'erreur, puis arrêt du script
 * Fonction appelée quand une erreur 'base de données' se produit :
 *      - lors de la phase de connexion au serveur MySQL
 *      - ou indirectement lorsque l'envoi d'une requête échoue
 *
 * @param string    $msg    Message d'erreur à afficher
 */
function bd_erreurExit($msg) {
    ob_end_clean(); // Supression de tout ce qui a pu être déja généré
    ob_start('ob_gzhandler');
    echo    '<!DOCTYPE html><html lang="fr"><head><meta charset="UTF-8"><title>',
            'Erreur base de données</title>',
            '<style>table{border-collapse: collapse;}td{border: 1px solid black;padding: 4px 10px;}</style>',
            '</head><body>',
            $msg,
            '</body></html>';

    exit(1);
}

//____________________________________________________________________________
/**
 * Gestion d'une erreur de requête à la base de données.
 *
 * A appeler impérativement quand un appel de mysqli_query() échoue 
 * Appelle la fonction xx_bd_erreurExit() qui affiche un message d'erreur puis termine le script
 *
 * @param objet     $bd     Connecteur sur la bd ouverte
 * @param string    $sql    requête SQL provoquant l'erreur
 */
function bd_erreur($bd, $sql) {
    $errNum = mysqli_errno($bd);
    $errTxt = mysqli_error($bd);

    // Collecte des informations facilitant le debugage
    $msg =  '<h4>Erreur de requête</h4>'
            ."<pre><b>Erreur mysql :</b> $errNum"
            ."<br> $errTxt"
            ."<br><br><b>Requête :</b><br> $sql"
            .'<br><br><b>Pile des appels de fonction</b></pre>';

    // Récupération de la pile des appels de fonction
    $msg .= '<table>'
            .'<tr><td>Fonction</td><td>Appelée ligne</td>'
            .'<td>Fichier</td></tr>';

    $appels = debug_backtrace();
    for ($i = 0, $iMax = count($appels); $i < $iMax; $i++) {
        $msg .= '<tr style="text-align: center;"><td>'
                .$appels[$i]['function'].'</td><td>'
                .$appels[$i]['line'].'</td><td>'
                .$appels[$i]['file'].'</td></tr>';
    }

    $msg .= '</table>';

    bd_erreurExit($msg);    // => ARRET DU SCRIPT
}
