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
		
		$resultat += getBateauSecteur($id, $idSecteur); // ajout du resultat booléen de réussite de cette requête.
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
		
		$resultat = modifierBateau( $nom, $id, $photo, $description, $longueur, $largeur, $vitesse_croisiere, $niveauPMR);

		/* on suprime les anciennes affectations de contenance */
		$resultat += SupprimerBateauSecteur($id); // ajout du resultat booléen de réussite de cette requête.

		/* on recrée les affectations de secteur de ce bateau */

		foreach ($secteurs as $idSecteur=>$value){
		$resultat += getBateauSecteur($id, $idSecteur); // ajout du resultat booléen de réussite de cette requête.
		}

		/* on suprime les anciennes affectations de contenance */

		$resultat += SupprimerBateauContenance($id); // ajout du resultat booléen de réussite de cette requête.

		/* on recrée les affectations de secteur de ce bateau */

		foreach ($categories as $lettreC=>$capaciteM){				
		$resultat += getContenanceBateau($idB, $lettreC, $capaciteM); // ajout du resultat booléen de réussite de cette requête.
	  	}

        $connexion->commit(); // fin de transaction

		if($resultat){
			$_SESSION['success'] = 'Bateau modifié';
		}		
		else{
			$_SESSION['error'] = 'Problème lors de la modification du bateau';
		}
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