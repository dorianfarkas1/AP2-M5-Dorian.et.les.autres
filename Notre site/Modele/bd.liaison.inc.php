<?php
include_once "bd.inc.php";

function getLiaisonBySecteur(int $idSecteur) : array {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM liaison JOIN secteur ON liaison.codeSecteur = secteur.id  WHERE secteur.id = :id ORDER BY secteur.nom");
        $req->bindValue(':id', $idSecteur, PDO::PARAM_INT);

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
// test si le premier include est la page appelée, permet dexecuter le fichier en local pour tester les fonctions
if ($includes[0] == __FILE__ ) {
    // prog principal de test
    header('Content-Type:text/plain');


    echo "getLiaison() : \n";
    print_r(getLiaison());

    echo "getLiaisonBySecteur(id) : \n";
    print_r(getLiaisonBySecteur(1));
}
?>