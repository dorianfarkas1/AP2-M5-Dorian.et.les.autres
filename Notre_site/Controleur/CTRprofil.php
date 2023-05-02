<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
// appel du script de vue qui permet de gerer l'affichage des donnees
if (isLoggedOn()){
    $mailU = getMailULoggedOn();
    $util = getUtilisateurByMailU($mailU);
    // traitement si necessaire des donnees recuperees
    // appel du script de vue qui permet de gerer l'affichage des donnees
    $titre = "Mon profil";
    include "$racine/Vue/menu.php";
    include "$racine/vue/vueMonProfil.php";
    include "$racine/Vue/pied_page.php";
}
else{
    $title = "Mon profil";
    include "$racine/Vue/menu.php";
    include "$racine/Vue/pied_page.php";
}
?>