<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.secteur.inc.php";

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesDestinations = getSecteurs();


// appel du script de vue qui permet de gerer l'affichage des donnees
$title = "Affichage des Secteurs";
include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/vue/visuSecteurs.php";
include "$racine/Vue/pied_page.php";
?>