<?php
include_once "bd.inc.php";

function getPeriode() : array {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from periode");
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

function getTarifs() : array {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * from tarification");
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

function getTarifsByPeriode(string $idPeriode) : array {
    $resultat = array(); 

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM tarification NATURAL JOIN type_billet NATURAL JOIN categorie NATURAL JOIN periode WHERE periode.idPeriode = :idPeriode ORDER BY tarif");
        $req->bindValue(':idPeriode', $idPeriode, PDO::PARAM_STR);
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

    echo "getPeriode() : \n";
    print_r(getPeriode());

    echo "getTarifs() : \n";
    print_r(getTarifs());

    echo "getTarifsByPeriode(idPeriode) : \n";
    print_r(getTarifsByPeriode("HF"));
}
?>