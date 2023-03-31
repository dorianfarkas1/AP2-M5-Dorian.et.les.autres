<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.bateau.inc.php";

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesNiveauPMR = getNiveauPMR();

if ((isset($_POST['niveauPMR'])) && ($_POST['niveauPMR'] != "")) {
    $niveauPMR = $_POST['niveauPMR'];
    $lesBateaux = getBateauByNiveauPMR($niveauPMR);
}
else{
    $lesBateaux = getBateau();
    
}


// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Affichage des Bateaux";
include "$racine/Vue/visuBateaux.php";
?>