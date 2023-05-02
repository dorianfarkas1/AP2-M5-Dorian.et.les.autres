<?php

if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.bateau.inc.php";
include_once "$racine/Modele/bd.secteur.inc.php";
include_once "$racine/Modele/bd.categorie.inc.php";

if(isset($_POST['add'])){

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

	if($resultat){
		$_SESSION["success"] = 'Bateau ajouté';
	}
	else{
		$_SESSION["error"] = 'Problème lors de l\'ajout du bateau';
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
			$_SESSION['success'] = 'Bateau modifié';
		}		
		else{
			$_SESSION['error'] = 'Problème lors de la modification du bateau';
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

		$id = $_POST['id'];
		$photoName = $_POST['old_photo'];
		if ($photoName != ""){
			unlink('./images/bateaux/' .$photoName);
		}

		$resultat = SupprimerBateau($id) ;

		if($resultat){
			$_SESSION['success'] = 'Bateau supprimé';
		}		
		else{
			$_SESSION['error'] = 'Problème lors de la suppression du bateau';
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
// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesBateaux = getlesBateaux();
$lesSecteurs = getSecteurs();
$lesNiveauPMRs = getNiveauPMR();
$lesCategories = getCategories();


// appel du script de vue qui permet de gerer l'affichage des donnees
$title = "CRUD des Bateaux";
include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/vueCrudbateau.php";
include "$racine/Vue/pied_page.php";
?>