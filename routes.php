<?php
	/* Détermination du nom de la page à charger après vérification de sa validité */
	$cheminPagesAffiche = "pages/"; 
	$title = "Page sans titre";
	$keywords = "";
	$description = "";
	
	/* choix de la valeur de la variable $affiche en fonction de parametre page transmis */
	$affiche = "lostinspace.php";
	if (!isset($_GET['action'])){
		$affiche = "presentation.php";
	} 
	else {
		switch ($_GET['action']) {
			case (""):
			case ("accueil"):
				$affiche = "presentation.php";
				$title = "Compagnie Océane - Accueil";
				$keywords = "accueil compagnie Océane";
				$description = "page d'accueil de la Compagnie Océane";
				break;
			case ("traversée"):
				$affiche = "trave.php";
				$title = "Compagnie Océane - Traversées";
				$keywords = "traversées compagnie Océane";
				$description = "page des traversées de la Compagnie Océane";
				break;
			case ("liaison"):
				$affiche = "liaison.php";
				$title = "Compagnie Océane - Liaisons";
				$keywords = "liaison compagnie Océane";
				$description = "page des liaisons de la Compagnie Océane";
				break;
			case ("afficheBateau"):
				$affiche = "visuBateaux.php";
				$title = "Compagnie Océane - Liste des bateaux";
				$keywords = "bateaux compagnie Océane";
				$description = "Affichage de la liste des bateaux de la Compagnie Océane";
				break;
			case ("tarif"):
				$affiche = "tarifs.php";
				$title = "Compagnie Océane - Tarifs";
				$keywords = "prix compagnie Océane";
				$description = "Affichage des tarifs de la Compagnie Océane";
				break;
			case ("affichePort"):
				$affiche = "visuPorts.php";
				$title = "Compagnie Océane - Liste des gares maritimes";
				$keywords = "gares compagnie Océane";
				$description = "Affichage de la liste des gares maritimes de la Compagnie Océane";
				break;
			case ("afficheSecteur"):
				$affiche = "visuSecteurs.php";
				$title = "Compagnie Océane - Destinations";
				$keywords = "destinations compagnie Océane";
				$description = "Affichage des destinations des traversées de la Compagnie Océane";
				break;

			

			case ("modifieBateau"):
				$affiche = "crudBateau.php";
				break;
			case ("bateauTraitement"):
				$affiche = "crudBateau/crudBateauTraitement.php";
				break;
				
			case ("modifiePort"):
				$affiche = "crudPort.php";
				break;
			case ("portTraitement"):
				$affiche = "crudPort/crudPortTraitement.php";
				break;
				
			default:
				$affiche = "lostinspace.php";
		}			
	}
    
    /* concatenation du chemin du dossier contenant les pages avec le contenu de $affiche */
    $affiche = $cheminPagesAffiche . $affiche; 
?>
