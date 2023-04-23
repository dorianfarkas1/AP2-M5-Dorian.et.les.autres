<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.bateau.inc.php";

// recuperation des donnees GET, POST et SESSION

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesBateaux = getBateau();

// appel du script de vue qui permet de gerer l'affichage des donnees
$title = "CRUD des Bateaux";
include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/vueCRUDBateau.php";
include "$racine/Vue/pied_page.php";
?>