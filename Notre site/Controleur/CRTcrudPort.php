<?php

if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.bateau.inc.php";
include_once "$racine/Modele/bd.secteur.inc.php";


// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesBateaux = getBateau();


// appel du script de vue qui permet de gerer l'affichage des donnees
$title = "CRUD des Ports";
include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/vueCrudportphp";
include "$racine/Vue/pied_page.php";
?>