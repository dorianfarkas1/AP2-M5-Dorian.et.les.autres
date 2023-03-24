Backoffice de la Compagnie Océane - en cours de développement
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
<!-- Copyright -->
<div class="footer-copyright text-center py-3">© Copyright 2022, TAB
</div>

<!-- Copyright -->
     