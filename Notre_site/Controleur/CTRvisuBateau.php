<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.bateau.inc.php";

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesNiveauxPMR = getNiveauPMR();

if ((isset($_POST['niveauPMR'])) && ($_POST['niveauPMR'] != "")) {
    $lesBateaux = getBateauByNiveauPMR($_POST['niveauPMR']);
}
else{
    $lesBateaux = getBateaux();
}


// appel du script de vue qui permet de gerer l'affichage des donnees
$title = "Affichage des Bateaux";

include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/visuBateaux.php";
include "$racine/Vue/pied_page.php";
?>