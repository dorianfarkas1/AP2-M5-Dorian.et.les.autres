<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.port.inc.php";

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesPorts = getPorts();

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Affichage des ports";
$keywords ="";
$description="";
include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/vue/visuPorts.php";
include "$racine/Vue/pied_page.php";
?>

