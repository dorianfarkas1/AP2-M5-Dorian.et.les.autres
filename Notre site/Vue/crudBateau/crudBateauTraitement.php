<?php
	include_once('BDD/connectBdd.php'); // cette page a besoin d'inclure le code qui crée l'objet PDO $connexion qui permet d'interroger la BDD


    

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
	
	if(isset($_POST['supr'])){
		$resultat = 0 ; // initialisation du booléen de réussite des requetes
    	$connexion->beginTransaction(); // debut de transaction

		$id = $_POST['id'];

		$photoName = $_POST['old_photo'];
		if ($photoName != ""){
			unlink('./images/bateaux/' .$photoName);
		}
		$req = $connexion->prepare('DELETE FROM contenance_bateau WHERE idBateau = :id  ');
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$resultat = $req->execute();
		$req = $connexion->prepare('DELETE FROM bateau_secteur WHERE idBateau = :id ');

		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$resultat += $req->execute();
		// suppression du bateau

		$req = $connexion->prepare('DELETE FROM bateau WHERE id = :id ');
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$resultat += $req->execute();
		
        $connexion->commit(); // fin de transaction
		
		if($resultat){
			$_SESSION['success'] = 'Bateau supprimé';
		}		
		else{
			$_SESSION['error'] = 'Problème lors de la suppression du bateau';
		}
		header('location: index.php?action=modifieBateau');
	}
?>


