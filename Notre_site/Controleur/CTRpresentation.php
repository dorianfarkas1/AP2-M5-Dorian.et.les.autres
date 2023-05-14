<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Acceuil du site";

include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/vue/presentation.php";
include "$racine/Vue/pied_page.php";

?>