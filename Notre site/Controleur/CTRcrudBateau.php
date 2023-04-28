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

	foreach ($categories as $key=>$value){
		$req3 = $connexion->prepare('INSERT INTO contenance_bateau (idBateau, lettreCategorie, capaciteMax) VALUES (:idBateau, :lettreCategorie, :capaciteMax)');				
		$req3->bindParam(':idBateau', $newId, PDO::PARAM_INT);
		$req3->bindParam(':lettreCategorie', $key, PDO::PARAM_STR);				
		$req3->bindParam(':capaciteMax', $value, PDO::PARAM_INT);				
		$resultat += $req3->execute(); // ajout du resultat booléen de réussite de cette requête.
	}

	$connexion->commit(); // fin de transaction

	if($resultat){
		$_SESSION["success"] = 'Bateau ajouté';
	}
	else{
		$_SESSION["error"] = 'Problème lors de l\'ajout du bateau';
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