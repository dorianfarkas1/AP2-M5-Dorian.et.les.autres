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

function getBateau() : array {
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

function ajouterBateau($nom) : array {
    $resultat = false;

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare('INSERT INTO bateau (nom) VALUES (:nom)');
        $req->bindParam(':nom', $nom, PDO::PARAM_STR);
        $resultat = $req->execute();

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

$includes = get_included_files();
// test si le premier include est la page appelée, permet dexecuter le fichier en local pour tester les fonctions
if ($includes[0] == __FILE__ ) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "getNiveauPMR() : \n";
    print_r(getNiveauPMR());
    
    echo "getBateau() : \n";
    print_r(getBateau());

    echo "getBateauById(id) : \n";
    print_r(getBateauById(8));

    echo "getBateauByNom(nom) : \n";
    print_r(getBateauByNom("kerdonis"));

    echo "getBateauByNiveauPMR(niveauPMR) : \n";
    print_r(getBateauByNiveauPMR(1));
}
?>