<?php
include_once "bd.inc.php";

function getLiaisonBySecteur($idSecteur) : array {
    $resultat = array();

    try {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT * from liaison join secteur on codeSecteur = id where codeSecteur = ?");
    $req->execute(array($idSecteur));
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
    $req = $cnx->prepare("SELECT * from liaison join secteur on codeSecteur = id");
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