<?php

function controleurPrincipal(string $action) : string {
    $lesActions = array();
    $lesActions["defaut"] = "presentation.php";
    $lesActions["afficheBateau"] = "visuBateaux.php";
    $lesActions["affichePort"] = "visuPorts.php";
    $lesActions["afficheSecteur"] = "visuSecteurs.php";
    $lesActions["afficheLiaison"] = "liaison.php";
    $lesActions["afficheTraversee"] = "trave.php";
    $lesActions["modifieBateau"] = "crudBateau.php";
    $lesActions["bateauTraitement"] = "crudBateau/crudBateauTraitement.php";
    $lesActions["modifiePort"] = "crudPort.php";
    $lesActions["portTraitement"] = "crudPort/crudPortTraitement.php";


    if (array_key_exists ( $action , $lesActions )){
        return $lesActions[$action];
    }
    else{
        return $lesActions["defaut"];
    }
}

?>