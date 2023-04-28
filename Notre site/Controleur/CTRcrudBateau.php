<?php

if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.bateau.inc.php";
include_once "$racine/Modele/bd.secteur.inc.php";

if(isset($_POST['add'])){
	$resultat = 0 ; // initialisation du booléen de réussite des requetes
	$connexion->beginTransaction(); // debut de transaction

	$nom = $_POST['nom'];
	$description = $_POST['description'];
	$longueur = $_POST['longueur'];
	$largeur = $_POST['largeur'];
	$vitesse = $_POST['vitesse'];
	$PMR = $_POST['PMR'];
	$secteurs = $_POST['secteurs'];
	$categories = $_POST['categories'];

	if(($_FILES['photo'])){
		$tmpName = $_FILES['photo']['tmp_name'];
		$photoName = $_FILES['photo']['name'];
		move_uploaded_file ($tmpName, './images/bateaux/'.$photoName);
	}

	$newId = getIdMax() +1;


	if(isset($_FILES['photo'])){
			$resultat = ajouteBateauAvecPhoto($newId, $nom, $photoName, $description, $longueur, $largeur, $vitesse, $PMR);
	}  
	else {
		$resultat = ajouterBateauSansPhoto($newId, $nom, $description, $longueur, $largeur, $vitesse, $PMR);
	}
	
	foreach ($secteurs as $idSecteur=>$value){
		
		$resultat += getBateauByIdBateauAndIdSecteur($id, $idSecteur); // ajout du resultat booléen de réussite de cette requête.
	}

	foreach ($categories as $lettreC=>$capaciteM){				
		$resultat += getContenanceBateau($idB, $lettreC, $capaciteM); // ajout du resultat booléen de réussite de cette requête.
	}

	$connexion->commit(); // fin de transaction

	if($resultat){
		$_SESSION["success"] = 'Bateau ajouté';
	}
	else{
		$_SESSION["error"] = 'Problème lors de l\'ajout du bateau';
	}
}

if(isset($_POST['edit'])){
		$resultat = 0 ; // initialisation du booléen de réussite des requetes
    	$connexion->beginTransaction(); // debut de transaction

		$id = $_POST['id'];
		$nom = $_POST['nom'];
		$description = $_POST['description'];
     	$longueur = $_POST['longueur'];
		$largeur = $_POST['largeur'];
		$vitesse = $_POST['vitesse'];
		$PMR = $_POST['PMR'];
		$secteurs = $_POST['secteurs'];
		$categories = $_POST['categories'];
		
		if(isset($_FILES['photo']) && $_FILES['photo']['name'] != ""){
			if ($photoName != ""){
				unlink('./images/bateaux/'.$photoName);
			}
			$tmpName = $_FILES['photo']['tmp_name'];
			$photoName = $_FILES['photo']['name']; // on ecrase la valeur
			move_uploaded_file($tmpName, './images/bateaux/'.$photoName);
		}
		$req = $connexion->prepare('UPDATE bateau SET nom = :nom, photo = :photo, description = :description, longueur = :longueur, largeur = :largeur, vitesse_croisiere = :vitesse_croisiere, niveauPMR = :niveauPMR WHERE id = :id');
		$req->bindParam(':nom', $nom, PDO::PARAM_STR);
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->bindParam(':photo', $photoName, PDO::PARAM_INT);
		$req->bindParam(':description', $description, PDO::PARAM_STR);
		$req->bindParam(':longueur', $longueur, PDO::PARAM_STR);
		$req->bindParam(':largeur', $largeur, PDO::PARAM_STR);
		$req->bindParam(':vitesse_croisiere', $vitesse, PDO::PARAM_STR);
		$req->bindParam(':niveauPMR', $PMR, PDO::PARAM_INT);
		$resultat = $req->execute();

		$req2 = $connexion->prepare('DELETE FROM bateau_secteur WHERE idBateau = :idBateau');
		$req2->bindParam(':idBateau', $id, PDO::PARAM_INT);
		$resultat += $req2->execute(); // ajout du resultat booléen de réussite de cette requête.

		/* on recrée les affectations de secteur de ce bateau */

		foreach ($secteurs as $key=>$value){
			$req3 = $connexion->prepare('INSERT INTO bateau_secteur (idBateau, idSecteur) VALUES (:idBateau, :idSecteur)');
			$req3->bindParam(':idBateau', $id, PDO::PARAM_INT);
			$req3->bindParam(':idSecteur', $key, PDO::PARAM_INT);
			$resultat += $req3->execute(); // ajout du resultat booléen de réussite de cette requête.
		}

		/* on suprime les anciennes affectations de contenance */

		$req4 = $connexion->prepare('DELETE FROM contenance_bateau WHERE idBateau = :idBateau');
		$req4->bindParam(':idBateau', $id, PDO::PARAM_INT);
		$resultat += $req4->execute(); // ajout du resultat booléen de réussite de cette requête.

		/* on recrée les affectations de secteur de ce bateau */

		foreach ($categories as $key=>$value){
			$req5 = $connexion->prepare('INSERT INTO contenance_bateau (idBateau, lettreCategorie, capaciteMax) VALUES (:idBateau, :lettreCategorie, :capaciteMax)');
			$req5->bindParam(':idBateau', $id, PDO::PARAM_INT);
			$req5->bindParam(':lettreCategorie', $key, PDO::PARAM_STR);
			$req5->bindParam(':capaciteMax', $value, PDO::PARAM_INT);
			$resultat += $req5->execute(); // ajout du resultat booléen de réussite de cette requête.
		}

        $connexion->commit(); // fin de transaction

		if($resultat){
			$_SESSION['success'] = 'Bateau modifié';
		}		
		else{
			$_SESSION['error'] = 'Problème lors de la modification du bateau';
		}
		header('location: index.php?action=modifieBateau');
	}
// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesBateaux = getBateau();
$lesSecteurs = getSecteurs();

// appel du script de vue qui permet de gerer l'affichage des donnees
$title = "CRUD des Bateaux";
include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/vueCRUDBateau.php";
include "$racine/Vue/pied_page.php";
?>