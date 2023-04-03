<?php

function controleurPrincipal(string $action) : string {
    $lesActions = array();
    $lesActions["defaut"] = "CTRpresentation.php";
    $lesActions["afficheBateau"] = "CTRvisuBateau.php";
    $lesActions["affichePort"] = "CTRvisuPorts.php";
    $lesActions["afficheSecteur"] = "CTRvisuSecteurs.php";
    $lesActions["liaison"] = "CTRliaison.php";
    $lesActions["afficheTraversee"] = "CTRtraversee.php";
    $lesActions["afficheTarif"] = "CTRtarifs.php";
    $lesActions["modifieBateau"] = "CTRcrudBateau.php";
    $lesActions["bateauTraitement"] = "CTRcrudBateau/crudBateauTraitement.php";
    $lesActions["modifiePort"] = "CTRcrudPort.php";
    $lesActions["portTraitement"] = "CTRcrudPort/crudPortTraitement.php";
<<<<<<< HEAD
    $lesActions["connexion"] = "connexion.php";
    $lesActions["deconnexion"] = "CTRdeconnexion.php";
=======
    $lesActions["connexion"] = "CTRconnexion.php";
    $lesActions["déconnexion"] = "CTRdéconnexion.php";
>>>>>>> e0fe28cb89b7518d8ea1499e3c9e274f3c6ebdd8


    if (array_key_exists ( $action , $lesActions )){
        return $lesActions[$action];
    }
    else{
        return $lesActions["defaut"];
    }
}

?>