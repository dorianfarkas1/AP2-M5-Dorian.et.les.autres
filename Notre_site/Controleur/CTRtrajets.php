<?php

if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}


// appel du script de vue qui permet de gerer l'affichage des donnees
$title = "Affichage des Trajets";
include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/vueCrudtrajet.php";
include "$racine/Vue/pied_page.php";
?>