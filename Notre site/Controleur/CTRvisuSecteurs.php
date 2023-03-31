<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.secteur.inc.php";

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesDestinations = getSecteurs();


// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Affichage des Secteurs";
include "$racine/vue/visuSecteurs.php";
?>