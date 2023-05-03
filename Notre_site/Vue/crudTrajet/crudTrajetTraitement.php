
<?php
	include_once('BDD/connectBdd.php'); // cette page a besoin d'inclure le code qui crée l'objet PDO $connexion qui permet d'interroger la BDD


	if(isset($_POST['add'])){
		$num = $_POST['num'];
    	$date = $_POST['date'];
    	$heure = $_POST['heure'];
    	$idLiaison = $_POST['codeLiaison'];
    	$idBateau = $_POST['idBateau'];

        $req = $connexion->prepare("INSERT INTO traversee (num, date, heure, codeLiaison, idBateau) VALUES (:num, :date, :heure, :codeLiaison, :idBateau)");

       $req->bindParam(':num', $num, PDO::PARAM_INT);
        $req->bindParam(':date', $date, PDO::PARAM_STR);
        $req->bindParam(':heure', $heure, PDO::PARAM_STR);
        $req->bindParam(':idLiaison', $idLiaison, PDO::PARAM_INT);
        $req->bindParam(':idBateau', $idBateau, PDO::PARAM_INT);


        $resultat = $req->execute();

		if($resultat){
			$_SESSION["success"] = 'Trajet ajouté';
		}
		else{
			$_SESSION["error"] = 'Problème lors de l\'ajout du trajet';
		}
		header('location: index.php?action=modifieTrajet');
	}
	
	if(isset($_POST['edit'])){
		$num = $_POST['num'];
    	$date = $_POST['date'];
    	$heure = $_POST['heure'];
    	$idLiaison = $_POST['codeLiaison'];
    	$idBateau = $_POST['idBateau'];
		
		
		$req = $connexion->prepare('UPDATE traversee SET num = :num, date=:date, heure =:heure, codeLiaison =:idLiaison, idBateau =:idBateau WHERE num =:num');
		
        $req->bindParam(':num', $num, PDO::PARAM_INT);
        $req->bindParam(':date', $date, PDO::PARAM_STR);
        $req->bindParam(':heure', $heure, PDO::PARAM_STR);
        $req->bindParam(':idLiaison', $idLiaison, PDO::PARAM_INT);
        $req->bindParam(':idBateau', $idBateau, PDO::PARAM_INT);
		$resultat = $req->execute();

		if($resultat){
			$_SESSION['success'] = 'Trajet modifié';
		}		
		else{
			$_SESSION['error'] = 'Problème lors de la modification du Trajet';
		}
		header('location: index.php?action=modifieTrajet');
	}
	
	if(isset($_POST['supr'])){
		$num = $_POST['num'];

		$req = $connexion->prepare('DELETE FROM traversee WHERE num =:num');
		 $req->bindParam(':num', $num, PDO::PARAM_INT);
		$resultat = $req->execute();
		if($resultat){
			$_SESSION['success'] = 'Trajet supprimé';
		}		
		else{
			$_SESSION['error'] = 'Problème lors de la suppression du Trajet';
		}
		header('location: index.php?action=modifieTrajet');
	}
?>