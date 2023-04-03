<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.secteur.inc.php";
include_once "$racine/Modele/bd.liaison.inc.php";

$lesVoyages = getSecteurs();
if ((isset($_POST['codeSecteur'])) && ($_POST['codeSecteur'] != "")){
    $lesLiaisons = getLiaisonBySecteur($_POST['codeSecteur']);
}
else {
    $lesLiaisons = getLiaison();
}
	
$titre = "Affichage des Liaisons";

include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/liaison.php";
include "$racine/Vue/pied_page.php";
?>