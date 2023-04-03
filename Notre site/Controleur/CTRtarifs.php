<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.tarif.inc.php";

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesPeriodes = getPeriode();

if ((isset($_POST['id'])) && ($_POST['id'] != "")){
     
    $idPeriode = $_POST['id'];
    $lesTarifs = getTarifsByPeriode($idPeriode);
    
}
else
{
    print "bonjour";
}

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Affichage des Tarifs";
include "$racine/vue/tarifs.php";
?>