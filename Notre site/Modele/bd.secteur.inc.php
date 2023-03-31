<?php
include_once "bd.inc.php";

function getSecteurById(int $id) : array {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from secteur where id=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}
function getSecteurs() : array {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from secteur");
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

function getSecteurByNomS(string $nomS) : array {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from secteur where nom like :nom");
        $req->bindValue(':nom', "%".$nomS."%", PDO::PARAM_STR);
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


    echo "getSecteurs() : \n";
    print_r(getSecteurs());

    echo "getSecteurById(id) : \n";
    print_r(getSecteurById(1));

    echo "getSecteurByNomS(nomS) : \n";
    print_r(getSecteurByNomS("Le Palais"));

}
?>