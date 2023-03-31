<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.tarif.inc.php";

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesPeriodes = getPeriode();
$lesTarifs = getTarifsByPeriode();


// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Affichage des Ports";
include "$racine/vue/visuPorts.php";
?>