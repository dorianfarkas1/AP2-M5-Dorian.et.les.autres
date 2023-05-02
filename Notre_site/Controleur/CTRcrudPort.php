<?php

if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.port.inc.php";

	if(isset($_POST['add'])){
    	
		$nomCourt = $_POST['nom_court'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $adresse = $_POST['adresse'];
        $camera = $_POST['camera'];

		if(($_FILES['photo'])){
			$tmpName = $_FILES['photo']['tmp_name'];
			$photoName = $_FILES['photo']['name'];
            move_uploaded_file ($tmpName, './images/ports/'.$photoName);
		}
		
		if(isset($_FILES['photo'])){

			$resultat = ajoutePortAvecPhoto(  $nomCourt, $nom, $description, $adresse, $photoName, $camera);

		} else {
			$resultat = ajoutePortSansPhoto( $nomCourt, $nom, $description, $adresse, $camera);

		}

		if($resultat){
			$_SESSION["success"] = 'Port ajouté';
		}
		else{
			$_SESSION["error"] = 'Problème lors de l\'ajout du port';
		}
	}
	
	if(isset($_POST['edit'])){
		$nomCourt = $_POST['nom_court'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $adresse = $_POST['adresse'];
        $camera = $_POST['camera'];
        $photoName = $_POST['old_photo'];
		
		if(isset($_FILES['photo'])){
			if ($photoName != ""){
				unlink('./images/ports/'.$photoName);
			}
			$tmpName = $_FILES['photo']['tmp_name'];
			$photoName = $_FILES['photo']['name']; // on ecrase la valeur
			move_uploaded_file($tmpName, './images/ports/'.$photoName);
		}

		$resultat = modifierPort($nomCourt, $nom, $description, $adresse, $photoName, $camera);

		if($resultat){
			$_SESSION['success'] = 'Port modifié';
		}		
		else{
			$_SESSION['error'] = 'Problème lors de la modification du Port';
		}
	}
	
	if(isset($_POST['supr'])){
		$id = $_POST['id'];

		$photoName = $_POST['old_photo'];
		if ($photoName != ""){
			unlink('./images/ports/' .$photoName);
		}
	
		$resultat = SupprimerPort($id) ;

		if($resultat){
			$_SESSION['success'] = 'Port supprimé';
		}		
		else{
			$_SESSION['error'] = 'Problème lors de la suppression du port';
		}
	}
// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesPorts = getPorts();


// appel du script de vue qui permet de gerer l'affichage des donnees
$title = "CRUD des Ports";
include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/vueCrudport.php";
include "$racine/Vue/pied_page.php";
?>