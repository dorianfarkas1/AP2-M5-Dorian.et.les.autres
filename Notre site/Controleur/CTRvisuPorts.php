<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.port.inc.php";

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesPorts = getPorts();

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Affichage des ports";
include "$racine/vue/visuPorts.php";
?>

