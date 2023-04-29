<?php

if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.bateau.inc.php";
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

           $resultat = ajoutePortAvecPhoto( $photo, $nom_court, $nom, $description, $adresse, $camera);

    } else {
		   $resultat = ajoutePortSansPhoto( $nom_court, $nom, $description, $adresse, $camera);

    }


		if($resultat){
			$_SESSION["success"] = 'Port ajouté';
		}
		else{
			$_SESSION["error"] = 'Problème lors de l\'ajout du port';
		}
	}
	
	if(isset($_POST['edit'])){
		$nomCourt = $_POST['id'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $adresse = $_POST['adresse'];
        $camera = $_POST['camera'];
        $photoName = $_POST['old_photo'];
		
		if(isset($_FILES['photo']) && $_FILES['photo']['name'] != ""){
			if ($photoName != ""){
				unlink('./images/ports/'.$photoName);
			}
			$tmpName = $_FILES['photo']['tmp_name'];
			$photoName = $_FILES['photo']['name']; // on ecrase la valeur
			move_uploaded_file($tmpName, './images/ports/'.$photoName);
		}
		$req = $connexion->prepare('UPDATE port SET nom = :nom, description = :description, adresse = :adresse, photo = :photo, camera = :camera WHERE nom_court = :nom_court');
		
        $req->bindParam(':nom_court', $nom_court, PDO::PARAM_STR);
        $req->bindParam(':nom', $nom, PDO::PARAM_STR);
        $req->bindParam(':description', $description, PDO::PARAM_STR);
        $req->bindParam(':adresse', $adresse, PDO::PARAM_STR);
		$req->bindParam(':photo', $photoName, PDO::PARAM_STR);
        $req->bindParam(':camera', $camera, PDO::PARAM_STR);
		$resultat = $req->execute();

		if($resultat){
			$_SESSION['success'] = 'Port modifié';
		}		
		else{
			$_SESSION['error'] = 'Problème lors de la modification du Port';
		}
		header('location: index.php?action=modifiePort');
	}
	
	if(isset($_POST['supr'])){
		$id = $_POST['id'];

		$photoName = $_POST['old_photo'];
		if ($photoName != ""){
			unlink('./images/ports/' .$photoName);
		}
		$req = $connexion->prepare('DELETE FROM port WHERE nom_court = :id ');
		$req->bindParam(':id', $id, PDO::PARAM_STR);
		$resultat = $req->execute();
		if($resultat){
			$_SESSION['success'] = 'Port supprimé';
		}		
		else{
			$_SESSION['error'] = 'Problème lors de la suppression du port';
		}
		header('location: index.php?action=modifiePort');
	}
// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesBateaux = getBateau();


// appel du script de vue qui permet de gerer l'affichage des donnees
$title = "CRUD des Ports";
include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/vueCrudportphp";
include "$racine/Vue/pied_page.php";
?>