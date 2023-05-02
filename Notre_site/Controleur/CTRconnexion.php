<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/Modele/authentification.inc.php";

// recuperation des donnees GET, POST, et SESSION
if (!isset($_POST["mailU"]) || !isset($_POST["mdpU"])){
    // on affiche le formulaire de connexion
    $title = "Authentification";
    include "$racine/vue/haut_page.php";
    include "$racine/Vue/menu.php";
    include "$racine/vue/Authentification.php";
    include "$racine/vue/pied_page.php";
}
else
{
    $mailU=$_POST["mailU"];
    $mdpU=$_POST["mdpU"];
    login($mailU,$mdpU);
    include "$racine/Vue/haut_page.php";
    if (isLoggedOn()){ // si l'utilisateur est connecté on redirige vers le controleur monProfil
        include "$racine/Controleur/CTRprofil.php";
    } else {
        // on affiche le formulaire de connexion
        $title = "Authentification";
        include "$racine/vue/haut_page.html.php";
        include "$racine/Vue/menu.php";
        include "$racine/vue/Authentification.php";
        include "$racine/vue/pied_page.php";
    }
}

// appel du script de vue qui permet de gerer l'affichage des donnees

?>