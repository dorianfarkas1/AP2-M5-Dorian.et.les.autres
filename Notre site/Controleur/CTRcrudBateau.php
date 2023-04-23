<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/bd.bateau.inc.php";

// recuperation des donnees GET, POST et SESSION
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

		$SQL = "SELECT max(id) FROM bateau";
		$stmt = $connexion->prepare($SQL);
		$stmt->execute();
		$lastId = $stmt->fetch();
		$newId = (int)$lastId[0] +1; // on lit la case du tableau de résultat


        if(isset($_FILES['photo'])){
            $req = $connexion->prepare('INSERT INTO bateau (id, nom, photo, description, longueur, largeur, vitesse_croisiere, niveauPMR) VALUES (:id, :nom, :photo, :description, :longueur, :largeur, :vitesse_croisiere, :niveauPMR)');
            $req->bindParam(':photo', $photoName, PDO::PARAM_STR);
        }  
	    else {
            $req = $connexion->prepare('INSERT INTO bateau (id, nom, description, longueur, largeur, vitesse_croisiere, niveauPMR) VALUES (:id, :nom, :description, :longueur, :largeur, :vitesse_croisiere, :niveauPMR)');;
        }
		$req->bindParam(':id', $newId, PDO::PARAM_INT);
        $req->bindParam(':nom', $nom, PDO::PARAM_STR);
		$req->bindParam(':description', $description, PDO::PARAM_STR);
        $req->bindParam(':longueur', $longueur, PDO::PARAM_STR);
        $req->bindParam(':largeur', $largeur, PDO::PARAM_STR);
        $req->bindParam(':vitesse_croisiere', $vitesse, PDO::PARAM_STR);
        $req->bindParam(':niveauPMR', $PMR, PDO::PARAM_INT);
		$resultat = $req->execute();

  
        foreach ($secteurs as $key=>$value){

			$req2 = $connexion->prepare('INSERT INTO bateau_secteur (idBateau, idSecteur) VALUES (:idBateau, :idSecteur)');
			$req2->bindParam(':idBateau', $newId, PDO::PARAM_INT);
			$req2->bindParam(':idSecteur', $key, PDO::PARAM_INT);			
			$resultat += $req2->execute(); // ajout du resultat booléen de réussite de cette requête.
			
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
		header('location: index.php?action=modifieBateau');
	}

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesBateaux = getBateau();

// appel du script de vue qui permet de gerer l'affichage des donnees
$title = "CRUD des Bateaux";
include "$racine/Vue/haut_page.php";
include "$racine/Vue/menu.php";
include "$racine/Vue/vueCrudbateau.php";
include "$racine/Vue/pied_page.php";
?>