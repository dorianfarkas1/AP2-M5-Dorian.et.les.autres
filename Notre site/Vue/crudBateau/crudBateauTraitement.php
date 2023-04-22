<?php
	include_once('BDD/connectBdd.php'); // cette page a besoin d'inclure le code qui crée l'objet PDO $connexion qui permet d'interroger la BDD

	if(isset($_POST['add'])){
		$nom = $_POST['nom'];
		$SQL = "SELECT max(id) FROM bateau";
			$stmt = $connexion->prepare($SQL);
			$stmt->execute();
			$lastId = $stmt->fetch();
			$newId = (int)$lastId[0] +1; // on lit la case du tableau de résultat
		if(isset($_FILES['photo'])){
			$tmpName = $_FILES['photo']['tmp_name'];
			$photoName = $_FILES['photo']['name'];
			move_uploaded_file($tmpName, './images/bateaux/'.$photoName);
			$req = $connexion->prepare('INSERT INTO bateau (id, nom, photo, description, longueur, largeur, vitesse_croisiere) VALUES (:id, :nom, :photo)');
    		$req->bindParam(':photo', $photoName, PDO::PARAM_STR);
		} 
		else {
    		$req = $connexion->prepare('INSERT INTO bateau (id, nom) VALUES (:id, :nom)');
		}
		$req->bindParam(':id', $newId, PDO::PARAM_INT);
		$req->bindParam(':nom', $nom, PDO::PARAM_STR);
		$resultat = $req->execute();


		if($resultat){
			$_SESSION["success"] = 'Bateau ajouté';
		}
		else{
			$_SESSION["error"] = 'Problème lors de l\'ajout du bateau';
		}
		header('location: index.php?action=modifieBateau');
	}
?>