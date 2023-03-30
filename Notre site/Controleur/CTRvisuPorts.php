<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}

	$SQL = "SELECT * FROM port";
	$stmt = $connexion->prepare($SQL);
	$stmt->execute(array()); // on passe dans le tableaux les paramètres si il y en a à fournir (aucun ici)
	$lesPorts = $stmt->fetchAll();


$lesPorts = getPorts();
// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Affichage des ports";
include "$racine/vue/visuPorts.php";
?>

