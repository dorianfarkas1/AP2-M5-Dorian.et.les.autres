<?php

if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.bateau.inc.php";
include_once "$racine/Modele/bd.traversee.inc.php";

$lesTraversees = getTraverseeBateau();

if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $longueur = $_POST['longueur'];
    $largeur = $_POST['largeur'];
    $vitesse = $_POST['vitesse'];
    $PMR = $_POST['PMR'];
    $secteurs = $_POST['secteurs'];
    $categories = $_POST['categories'];
    
    $resultat = modifierBateau( $nom, $id, $longueur, $largeur, $vitesse, $PMR);

    if($resultat){
        $_SESSION['success'] = 'Bateau affecté';
    }		
    else{
        $_SESSION['error'] = "Problème lors de l'affectation du bateau";
    }
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
}

// appel du script de vue qui permet de gerer l'affichage des donnees
$title = "Affecter Bateau";
include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/vueCrudaffecte.php";
include "$racine/Vue/pied_page.php";
?>