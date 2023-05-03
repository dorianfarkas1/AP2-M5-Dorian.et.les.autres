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

function getTraversees() : array {
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

function getTraverseeBateau() : array {
    $resultat = array();
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM traversee join bateau on traversee.idBateau = bateau.id");
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

function ajouterTraversee($num, $date, $heure, $idLiaison, $idBateau) : bool {
    $resultat = false;

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO traversee (num, date, heure, codeLiaison, idBateau) VALUES (:num, :date, :heure, :codeLiaison, :idBateau)");
        $req->bindParam(':num', $num, PDO::PARAM_INT);
        $req->bindParam(':date', $date, PDO::PARAM_STR);
        $req->bindParam(':heure', $heure, PDO::PARAM_STR);
        $req->bindParam(':idLiaison', $idLiaison, PDO::PARAM_INT);
        $req->bindParam(':idBateau', $idBateau, PDO::PARAM_INT);
        $resultat = $req->execute();

        
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

function modifierTrajet($num, $date, $heure, $idLiaison, $idBateau): bool {
        $resultat = false;
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare('UPDATE traversee SET num = :num, date=:date, heure =:heure, codeLiaison =:idLiaison, idBateau =:idBateau WHERE num =:num');
        $req->bindParam(':num', $num, PDO::PARAM_INT);
        $req->bindParam(':date', $date, PDO::PARAM_STR);
        $req->bindParam(':heure', $heure, PDO::PARAM_STR);
        $req->bindParam(':idLiaison', $idLiaison, PDO::PARAM_INT);
        $req->bindParam(':idBateau', $idBateau, PDO::PARAM_INT);
        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function SupprimerTrajet($num) : bool {
    $resultat = false;
try {
    $cnx = connexionPDO();
    $req = $cnx->prepare('DELETE FROM traversee WHERE num =:num');
    $req->bindParam(':num', $num, PDO::PARAM_INT);;
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


    echo "getLiaison() : \n";
    print_r(getLiaison());

    echo "getTraverseeByIdANDByDate(code) : \n";
    print_r(getTraverseeByIdANDByDate(11, "2022-09-01"));

}

?>