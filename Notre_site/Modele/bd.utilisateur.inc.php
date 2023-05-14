<?php

include_once "bd.inc.php";

function getUtilisateurs() : array {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from utilisateur");
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

function getUtilisateurByMailU(string $mailU) : array {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from utilisateur where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function ajouteUtil( $mailU, $mdp, $pseudo) : bool {
    $resultat = false;
try {
    $cnx = connexionPDO();
    $req = $cnx->prepare('INSERT INTO utilisateur (mailU, mdpU, pseudoU) VALUES (:mailU, :mdp, :pseudo)');
    $req->bindParam(':mailU', $mailU, PDO::PARAM_STR);
    $req->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
   
    $resultat = $req->execute();

} catch (PDOException $e) {
print "Erreur !: " . $e->getMessage();
die();
}
return $resultat;
}

function modifieUtil( $mailU, $mdp, $pseudo) : bool {
    $resultat = false;
try {
    $cnx = connexionPDO();
    $req = $cnx->prepare('UPDATE utilisateur SET mdpU = :mdp, pseudoU = :pseudo WHERE mailU = :mailU');
    $req->bindParam(':mailU', $mailU, PDO::PARAM_STR);
    $req->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    
    $resultat = $req->execute();
    
} catch (PDOException $e) {
print "Erreur !: " . $e->getMessage();
die();
}
return $resultat;
}

function SupprimeUtil($mailU) : bool {
    $resultat = false;
try {
    $cnx = connexionPDO();
    $req = $cnx->prepare('DELETE FROM utilisateur WHERE mailU = :mailU ');
    $req->bindParam(':mailU', $mailU, PDO::PARAM_STR);;
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
    header('Content-Type:text/plain');

    echo "getUtilisateurs() : \n";
    print_r(getUtilisateurs());

    echo "getUtilisateurByMailU('mathieu.capliez@gmail.com') : \n";
    print_r(getUtilisateurByMailU("mathieu.capliez@gmail.com"));

}
?>