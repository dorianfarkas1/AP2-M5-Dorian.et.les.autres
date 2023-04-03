<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.traversee.inc.php";

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesLiaisons = getLiaison();


if ((isset($_POST['route'])) && ($_POST['route'] != "")){
	$code = $_POST['route'];
    $lesTraversees = getTraverseeById($code);
}

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Affichage des Traversee";
include "$racine/Vue/traversee.php";
?>