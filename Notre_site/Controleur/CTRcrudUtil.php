<?php

if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.utilisateur.inc.php";
$lesUtilisateurs = getUtilisateurs();

if(isset($_POST['add'])){
    	
    $mailU = $_POST['mail_U'];
    $mdp = $_POST['mdp_U'];
    $pseudo = $_POST['pseudo_U'];
 

    $resultat = ajouteUtil($mailU, $mdp, $pseudo);

    if($resultat){
        $_SESSION["success"] = 'Utilisateur ajouté';
    }
    else{
        $_SESSION["error"] = 'Problème lors de l\'ajout du user';
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

if(isset($_POST['edit'])){
    $mailU = $_POST['mail_U'];
    $mdp = $_POST['Mdp_U'];
    $pseudo = $_POST['pseudo_U'];
    

    $resultat = modifieUtil($mailU, $mdp, $pseudo);

    if($resultat){
        $_SESSION['success'] = 'Utilisateur modifié';
    }		
    else{
        $_SESSION['error'] = 'Problème lors de la modification du user';
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

if(isset($_POST['supr'])){
    $mailU = $_POST['mail_U'];

    $resultat = SupprimeUtil($mailU) ;

    if($resultat){
        $_SESSION['success'] = 'Utilisateur supprimé';
    }		
    else{
        $_SESSION['error'] = 'Problème lors de la suppression du port';
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


$title = "CRUD des Utilisateurs";
include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/vueCrudUtil.php";
include "$racine/Vue/pied_page.php";
?>