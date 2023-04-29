<?php
include_once "bd.inc.php";

function getPorts() : array {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from port");
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

function getPortsByNomC(string $nomC) : array {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from port where nom_court like :nom_court");
        $req->bindValue(':nom_court', "%".$nomC."%", PDO::PARAM_STR);
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

function getRestosByAdresse(string $adresse) : array {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from resto where adresse like :adresse");
        $req->bindValue(':adresse', "%".$adresse."%", PDO::PARAM_STR);
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

function ajoutePortAvecPhoto( $nom_court, $nom, $description, $adresse, $photo, $camera) : bool {
    $resultat = false;
    try {
            $cnx = connexionPDO();
            $req = $cnx->prepare('INSERT INTO port (nom_court, nom, description, adresse, photo, camera) VALUES (:id, :nom, :description, :adresse, :photo, :camera)');
            $req->bindParam(':id', $nom_court, PDO::PARAM_STR);
            $req->bindParam(':nom', $nom, PDO::PARAM_STR);
            $req->bindParam(':description', $description, PDO::PARAM_STR);
            $req->bindParam(':adresse', $adresse, PDO::PARAM_STR);
              $req->bindParam(':photo', $photo, PDO::PARAM_STR);
            $req->bindParam(':camera', $camera, PDO::PARAM_STR);
            $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function ajoutePortSansPhoto( $nom_court, $nom, $description, $adresse, $camera) : bool {
    $resultat = false;
    try {
            $cnx = connexionPDO();
            $req = $cnx->prepare('INSERT INTO port (nom_court, nom, description, adresse, camera) VALUES (:id, :nom, :description, :adresse, :camera)');
            $req->bindParam(':id', $nom_court, PDO::PARAM_STR);
            $req->bindParam(':nom', $nom, PDO::PARAM_STR);
            $req->bindParam(':description', $description, PDO::PARAM_STR);
            $req->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $req->bindParam(':camera', $camera, PDO::PARAM_STR);
            $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function modifierPort( $nom_court, $nom, $description, $adresse, $photo, $camera): bool {
    $resultat = false;
    try {
            $cnx = connexionPDO();
            $req = $cnx->prepare('UPDATE port SET nom = :nom, description = :description, adresse = :adresse, photo = :photo, camera = :camera WHERE nom_court = :nom_court');
            $req->bindParam(':nom_court', $nom_court, PDO::PARAM_STR);
            $req->bindParam(':nom', $nom, PDO::PARAM_STR);
            $req->bindParam(':description', $description, PDO::PARAM_STR);
            $req->bindParam(':adresse', $adresse, PDO::PARAM_STR);
		    $req->bindParam(':photo', $photo, PDO::PARAM_STR);
            $req->bindParam(':camera', $camera, PDO::PARAM_STR);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function SupprimerPort($id) : bool {
    $resultat = false;
try {
    $cnx = connexionPDO();
    $req = $cnx->prepare('DELETE FROM port WHERE nom_court = :id ');
    $req->bindParam(':id', $id, PDO::PARAM_STR);;
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


    echo "getPorts() : \n";
    print_r(getPorts());

    echo "getPortsByNomC(nomC) : \n";
    print_r(getPortsByNomC("Le Palais"));

    echo "getRestosByAdresse(adresse) : \n";
    print_r(getRestosByAdresse("Quai Bonnelle 56360 Le Palais"));
}
?>