<?php
include_once "bd.inc.php";

function getNiveauPMR() : array {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * from niveau_accessibilite");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getBateauById(int $id) : array {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * from bateau where id=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getBateaux() : array {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * from bateau ");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


function getBateauByNom(string $nom) : array {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * from bateau where nom like $nom");
        $req->bindValue(':nom', "%".$nom."%", PDO::PARAM_STR);
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getBateauByNiveauPMR(string $niveauPMR) : array {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * from bateau b join niveau_accessibilite n on b.niveauPMR = n.idNiveau where niveauPMR = $niveauPMR ORDER BY b.nom");
        $req->bindValue(':niveauPMR', "%".$niveauPMR."%", PDO::PARAM_STR);
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getSecteurBateau(int $idB) : array {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare('SELECT idSecteur FROM bateau_secteur WHERE idBAteau = :id');
        $req->bindParam(':id', $idB, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


function ajouteBateauAvecPhoto($id, $nom, $photo, $description, $longueur, $largeur, $vitesse_croisiere, $niveauPMR) : bool {
    $resultat = false;
    try {
            $cnx = connexionPDO();
            $req = $cnx->prepare('INSERT INTO bateau (id, nom, photo, description, longueur, largeur, vitesse_croisiere, niveauPMR) VALUES (:id, :nom, :photo, :description, :longueur, :largeur, :vitesse_croisiere, :niveauPMR)');
            $req->bindParam(':photo', $photo, PDO::PARAM_STR);
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->bindParam(':nom', $nom, PDO::PARAM_STR);
            $req->bindParam(':description', $description, PDO::PARAM_STR);
            $req->bindParam(':longueur', $longueur, PDO::PARAM_STR);
            $req->bindParam(':largeur', $largeur, PDO::PARAM_STR);
            $req->bindParam(':vitesse_croisiere', $vitesse_croisiere, PDO::PARAM_STR);
            $req->bindParam(':niveauPMR', $niveauPMR, PDO::PARAM_INT);
            $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


function getIdMax() : int {
    $resultat = 0;
    try {
            $cnx = connexionPDO();
            $stmt = $cnx->prepare('SELECT max(id) FROM bateau');
            $stmt->execute();
            $res = $stmt->fetch();
            $resultat = $res[0];
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function ajouterBateauSansPhoto($id, $nom, $description, $longueur, $largeur, $vitesse, $PMR) : bool {
    $resultat = false;
    try {
            $cnx = connexionPDO();
            $req = $cnx->prepare('INSERT INTO bateau (id, nom, description, longueur, largeur, vitesse_croisiere, niveauPMR) VALUES (:id, :nom, :photo, :description, :longueur, :largeur, :vitesse_croisiere, :niveauPMR)');
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->bindParam(':nom', $nom, PDO::PARAM_STR);
            $req->bindParam(':description', $description, PDO::PARAM_STR);
            $req->bindParam(':longueur', $longueur, PDO::PARAM_STR);
            $req->bindParam(':largeur', $largeur, PDO::PARAM_STR);
            $req->bindParam(':vitesse_croisiere', $vitesse, PDO::PARAM_STR);
            $req->bindParam(':niveauPMR', $PMR, PDO::PARAM_INT);
            $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

 function getBateauSecteur($id, $key) : bool {
            $resultat = false;
    try {
            $cnx = connexionPDO();
            $req = $cnx->prepare('INSERT INTO bateau_secteur (idBateau, idSecteur) VALUES (:idBateau, :idSecteur)');
            $req->bindParam(':idBateau', $id, PDO::PARAM_INT);
		    $req->bindParam(':idSecteur', $key, PDO::PARAM_INT);
            $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getContenanceBateau($idB, $key, $value) : bool {
    $resultat = false;
try {
    $cnx = connexionPDO();
    $req = $cnx->prepare('INSERT INTO contenance_bateau (idBateau, lettreCategorie, capaciteMax) VALUES (:idBateau, :lettreCategorie, :capaciteMax)');
    $req->bindParam(':idBateau', $idB, PDO::PARAM_INT);
	$req->bindParam(':lettreCategorie', $key, PDO::PARAM_STR);				
	$req->bindParam(':capaciteMax', $value, PDO::PARAM_INT);
    $resultat = $req->execute();
} catch (PDOException $e) {
print "Erreur !: " . $e->getMessage();
die();
}
return $resultat;
}

function modifierBateau( $nom, $id, $photo, $description, $longueur, $largeur, $vitesse_croisiere, $niveauPMR) : bool {
    $resultat = false;
    try {
            $cnx = connexionPDO();
            $req = $cnx->prepare('UPDATE bateau SET nom = :nom, photo = :photo, description = :description, longueur = :longueur, largeur = :largeur, vitesse_croisiere = :vitesse_croisiere, niveauPMR = :niveauPMR WHERE id = :id');
            $req->bindParam(':nom', $nom, PDO::PARAM_STR);
		    $req->bindParam(':id', $id, PDO::PARAM_INT);
		    $req->bindParam(':photo', $photo, PDO::PARAM_INT);
		    $req->bindParam(':description', $description, PDO::PARAM_STR);
		    $req->bindParam(':longueur', $longueur, PDO::PARAM_STR);
		    $req->bindParam(':largeur', $largeur, PDO::PARAM_STR);
		    $req->bindParam(':vitesse_croisiere', $vitesse_croisiere, PDO::PARAM_STR);
		    $req->bindParam(':niveauPMR', $niveauPMR, PDO::PARAM_INT);
            $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function SupprimerBateauSecteur($id) : bool {
    $resultat = false;
try {
    $cnx = connexionPDO();
    $req = $cnx->prepare('DELETE FROM bateau_secteur WHERE idBateau = :idBateau');
    $req->bindParam(':idBateau', $id, PDO::PARAM_INT);
    $resultat = $req->execute();
} catch (PDOException $e) {
print "Erreur !: " . $e->getMessage();
die();
}
return $resultat;
}

function SupprimerBateauContenance($id) : bool {
    $resultat = false;
try {
    $cnx = connexionPDO();
    $req = $cnx->prepare('DELETE FROM contenance_bateau WHERE idBateau = :idBateau');
    $req->bindParam(':idBateau', $id, PDO::PARAM_INT);
    $resultat = $req->execute();
} catch (PDOException $e) {
print "Erreur !: " . $e->getMessage();
die();
}
return $resultat;
}

function SupprimerBateau($id) : bool {
    $resultat = false;
try {
        $cnx = connexionPDO();
        $req = $cnx->prepare('DELETE FROM bateau WHERE id = :id ');
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $resultat = $req->execute();
} catch (PDOException $e) {
print "Erreur !: " . $e->getMessage();
die();
}
return $resultat;
}

$includes = get_included_files();
// test si le premier include est la page appelée, permet dexecuter le fichier en local pour tester les fonctions
if ($includes[0] == __FILE__ ) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "getNiveauPMR() : \n";
    print_r(getNiveauPMR());
    
    echo "getBateau() : \n";
    print_r(getBateaux());

    echo "getBateauById(id) : \n";
    print_r(getBateauById(8));

    echo "getBateauByNom(nom) : \n";
    print_r(getBateauByNom("kerdonis"));

    echo "getBateauByNiveauPMR(niveauPMR) : \n";
    print_r(getBateauByNiveauPMR(1));
}
?>