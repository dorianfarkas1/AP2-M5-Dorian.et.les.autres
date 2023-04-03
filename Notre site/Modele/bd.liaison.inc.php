<?php
include_once "bd.inc.php";

function getLiaisonBySecteur($idSecteur) : array {
    $resultat = array();

    try {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT * FROM liaison JOIN secteur ON liaison.codeSecteur = secteur.id  WHERE secteur.id = ? ORDER BY secteur.nom ");
    $req->bindValue($idSecteur, PDO::PARAM_INT);
    $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } 
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat ;
}

function getLiaison() : array {
    $resultat = array();

    try {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT * FROM liaison JOIN secteur ON liaison.codeSecteur = secteur.id   ORDER BY secteur.nom");
    $req->execute();

    $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } 
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat ;
}

$includes = get_included_files();
?>