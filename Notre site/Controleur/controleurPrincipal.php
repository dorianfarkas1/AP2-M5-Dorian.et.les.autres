<?php

function controleurPrincipal(string $action) : string {
    $lesActions = array();
    $lesActions["defaut"] = "CTRpresentation.php";
    $lesActions["afficheBateau"] = "CTRvisuBateau.php";
    $lesActions["affichePort"] = "CTRvisuPorts.php";
    $lesActions["afficheSecteur"] = "CTRvisuSecteurs.php";
<<<<<<< HEAD
    $lesActions["liaison"] = "CTRliaison.php";
    $lesActions["afficheTraversee"] = "CTRtrave.php";
=======
    $lesActions["afficheLiaison"] = "CTRliaison.php";
    $lesActions["afficheTraversee"] = "CTRtraversee.php";
>>>>>>> a1743691a3043cf5cf8e40c385f15e4d58ee1340
    $lesActions["afficheTarif"] = "CTRtarifs.php";
    $lesActions["modifieBateau"] = "CTRcrudBateau.php";
    $lesActions["bateauTraitement"] = "CTRcrudBateau/crudBateauTraitement.php";
    $lesActions["modifiePort"] = "CTRcrudPort.php";
    $lesActions["portTraitement"] = "CTRcrudPort/crudPortTraitement.php";
    $lesActions["connexion"] = "connexion.php";
    $lesActions["déconnexion"] = "déconnexion.php";


    if (array_key_exists ( $action , $lesActions )){
        return $lesActions[$action];
    }
    else{
        return $lesActions["defaut"];
    }
}

?>