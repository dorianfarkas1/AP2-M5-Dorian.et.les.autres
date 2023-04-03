<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/modele/authentification.inc.php";

// recuperation des donnees GET, POST, et SESSION

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 

// traitement si necessaire des donnees recuperees
logout();      

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Deconnexion";
$titre = "Affichage des Liaisons";
$keywords ="";
$description="";

include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/deconnexion.php";
include "$racine/Vue/pied_page.php";


?>