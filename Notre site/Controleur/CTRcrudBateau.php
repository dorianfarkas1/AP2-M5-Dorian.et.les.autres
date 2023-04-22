<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.bateau.inc.php";

// recuperation des donnees GET, POST et SESSION
if(isset ($_POST['add']))
{
    $nom = htmlentities($_POST['nom']);
    
    $resultat = ajouterBateau($nom);

    if($resultat)
    {
        $_SESSION["success"] = 'Bateau ajouté';
    }
    else
    {
        $_SESSION["error"] = 'Problème lors de l\'ajout du bateau';
    }
}

if(isset($_POST['edit'])){
    $id = htmlentities($_POST['id'];)
    $nom = htmlentities($_POST['nom']);
    $photoName = htmlentities($_POST['old_photo']);
    if(isset($_FILES['photo'])){
        unlink('./images/bateaux/'.$photoName);
        $tmpName = $_FILES['photo']['tmp_name'];
        $photoName = $_FILES['photo']['name'];
        move_uploaded_file($tmpName, './images/bateaux/'.$photoName);
    }
    $resultat = modifierBateau($id, $nom, $photoName);

    if($resultat){
        $_SESSION['success'] = 'Bateau modifié';
    }		
    else{
        $_SESSION['error'] = 'Problème lors de la modification du bateau';
    }
}

if(isset($_POST['supr'])){
    $id = htmlentities($_POST['id']);
    $photoName = htmlentities($_POST['old_photo']);
    if ($photoName != ""){
           unlink('./images/bateaux/'.$photoName);
    }
    $resultat = supprimerBateau($id);
    
    if($resultat){
        $_SESSION['success'] = 'Bateau supprimé';
    }		
    else{
        $_SESSION['error'] = 'Problème lors de la suppression du bateau';
    }
}

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesBateaux = getBateau();

// appel du script de vue qui permet de gerer l'affichage des donnees
$title = "CRUD des Bateaux";
include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/vueCRUDBateau.php";
include "$racine/Vue/pied_page.php";
?>