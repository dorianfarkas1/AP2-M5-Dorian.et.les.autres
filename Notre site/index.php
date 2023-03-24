<?php
include "getRacine.php";
include "$racine/Controleur/controleurPrincipal.php";
include_once "$racine/Modele/authentification.inc.php"; // pour pouvoir utiliser isLoggedOn()

if (isset($_GET["action"])){
    $action = $_GET["action"];
}
else{
    
    $action = "defaut";
}

$fichier = controleurPrincipal($action);
include "$racine/Controleur/$fichier";

?>
     