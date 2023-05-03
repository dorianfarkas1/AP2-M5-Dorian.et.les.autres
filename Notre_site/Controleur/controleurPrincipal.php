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
   // $lesActions["bateauTraitement"] = "CTRcrudBateau/crudBateauTraitement.php";
    $lesActions["modifiePort"] = "CTRcrudPort.php";
    //$lesActions["portTraitement"] = "CTRcrudPort/crudPortTraitement.php";
    $lesActions["modifieTrajet"] = "CTRtrajets.php";
    $lesActions["affecterBateau"] = "CTRaffecteBateau.php";
    $lesActions["modifieUtil"] = "CTRcrudUtil.php";
    $lesActions["deconnexion"] = "CTRdeconnexion.php";
    $lesActions["connexion"] = "CTRconnexion.php";
    $lesActions["deconnexion"] = "CTRdeconnexion.php";

    if (array_key_exists ( $action , $lesActions )){
        return $lesActions[$action];
    }
    else{
        return $lesActions["defaut"];
    }
}

?>