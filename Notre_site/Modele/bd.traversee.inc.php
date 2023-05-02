<?php
include_once "bd.inc.php";

function getLiaison() : array {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT CONCAT(portDepart,'-', portArrivee,'(', nom,')') AS trajet, code FROM liaison l JOIN secteur s ON l.codeSecteur = s.id");
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

function getTraversee() : array {
    $resultat = array();
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM traversee");
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

function ajouterLiaison($num, $date, $heure, $nom) : array {
    $resultat = false;

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO traversee (num, date, heure, nom) VALUES (:num, :date, :heure, :nom)");
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

function getTraverseeByIdANDByDate(int $code, string $date) : array {
    $resultat = array();
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM traversee t JOIN liaison l ON t.codeLiaison = l.code JOIN bateau b ON t.idBateau = b.id WHERE l.code = :code AND date = :date");
        $req->bindValue(':code', $code, PDO::PARAM_INT);
        $req->bindValue(':date', $date, PDO::PARAM_STR);

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


    echo "getLiaison() : \n";
    print_r(getLiaison());

    echo "getTraverseeByIdANDByDate(code) : \n";
    print_r(getTraverseeByIdANDByDate(11, "2022-09-01"));

}

?>