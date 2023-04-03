<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/authentification.inc.php";

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Deconnexion";
include "$racine/vue/déconnexion.php";
?>