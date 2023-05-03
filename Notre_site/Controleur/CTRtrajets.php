<?php

if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.traversee.inc.php";
if(isset($_POST['add']))
{
    $num = $_POST['num'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $idLiaison = $_POST['codeLiaison'];
    $idBateau = $_POST['idBateau'];

    $resultat = ajouterTraversee($num, $date, $heure, $idLiaison, $idBateau);

    if($resultat){
        $_SESSION['success'] = 'Trajet ajoutée';
    }		
    else{
        $_SESSION['error'] = 'Problème lors de la suppression du trajet';
    }
}

$lesTrajets = getTraversees();

// appel du script de vue qui permet de gerer l'affichage des donnees
$title = "Affichage des Trajets";
include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/vueCrudtrajet.php";
include "$racine/Vue/pied_page.php";
?>