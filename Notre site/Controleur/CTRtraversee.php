<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.traversee.inc.php";

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesLiaisons = getLiaison();

$date = date("Y-m-d");// date par défaut aujourd'hui

    if (isset($_POST['date'])) {

        $date = $_POST['date']; // si on a sélectionné une date précédemment, on remplace la date du jour par celle-ci

    }

if ((isset($_POST['route'])) && ($_POST['route'] != "")){
	$code = $_POST['route'];
    $lesTraversees = getTraverseeById($code);
}
else{
    $lesBateaux = getBateau();
    
}


// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Affichage des Traversee";
include "$racine/Vue/traversee.php";
?>