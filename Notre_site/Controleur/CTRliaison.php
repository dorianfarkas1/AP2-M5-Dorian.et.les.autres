<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.secteur.inc.php";
include_once "$racine/Modele/bd.liaison.inc.php";

$lesSecteurs = getSecteurs();

if ((isset($_POST['id'])) && ($_POST['id'] != "")){
    
    $idSecteur = $_POST['id'];

    $lesLiaisons = getLiaisonBySecteur($idSecteur);
}
else {
    $lesLiaisons = getLiaison();
}
	
$titre = "Affichage des Liaisons";
$keywords ="";
$description="";

include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/liaison.php";
include "$racine/Vue/pied_page.php";
?>
