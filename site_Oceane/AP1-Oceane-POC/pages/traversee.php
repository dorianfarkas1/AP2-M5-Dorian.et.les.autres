<?php
	include_once('BDD/connectBdd.php'); // cette page a besoin d'inclure le code qui crée l'objet PDO $connexion qui permet d'interroger la BDD

	
    $SQL = "SELECT code, CONCAT(liaison.portDepart,' - ', liaison.portArrivee, '(',secteur.nom,')' )AS trajet FROM liaison JOIN secteur ON liaison.codeSecteur = secteur.id"; 
    $stmt = $connexion->prepare($SQL);
    $stmt->execute(array()); // on passe dans le tableaux les paramètres si il y en a à fournir (aucun ici)
    $lesLiaisons = $stmt->fetchAll(PDO::FETCH_ASSOC); // on met le resultat de la requete dans un tableau
    $stmt->closeCursor(); // on ferme le curseur des résultats
?>	
	
<h1 class="page-header text-center">Traversés assurées par la compagnie</h1>


<form method="post" action="index.php?action=traversee">
    <div>
        <label for="route">Choisir une liaison :</label>
        <select name="route">
		    <option value="">--sélectionner une liaison--</option>
			<?php
			foreach ($lesLiaisons as $uneLiaison) {
				$selected = "";
				if ((isset($_POST['route'])) && ($_POST['route']==$uneLiaison['code'])) {
					$selected = "selected";
				}
				echo '<option value="'.$uneLiaison['code'].'" '.$selected.'>'.$uneLiaison['trajet'].'</option>';
			}
			?>
	    </select>
    </div>

    <div>

        <label for="date">Choix d'une date :</label>

            <?php

                $date = date("Y-m-d");// date par défaut aujourd'hui

                if (isset($_POST['date'])) {

                $date = $_POST['date']; // si on a sélectionné une date précédemment, on remplace la date du jour par celle-ci

                }

            ?>

        <input type="date" id="date" name="date" value="<?= $date ?>">

    </div>
	    <input type="submit" value="Afficher les traversées" title="Afficher les traversées" />
</form>

<br>

<?php
if ((isset($_POST['route'])) && ($_POST['route'] != "")){
	$traverses = $_POST['route'];
	$SQL = "SELECT * FROM traversee t JOIN bateau b ON t.idBateau = b.id WHERE date= ? AND codeLiaison= ? ORDER BY heure ASC";
	$stmt = $connexion->prepare($SQL);
	$stmt->execute(array($date,$traverses)); // on passe dans le tableaux les paramètres si il y en a à fournir
	$lesTraversees = $stmt->fetchAll(); ?>


	<div class="row">
		<table id="myTable" class="table table-bordered table-striped">
			<thead>
				<th>Numéro de traversée </th>
				<th>Date de Départ</th>
				<th>Heure de départ </th>
				<th>Nom du navire</th>
				
			</thead>
			<tbody>
				<?php
					foreach ($lesTraversees as $uneTraversee){
					?>
						<tr>
							<td><?= $uneTraversee['num'] ?></td>
							<td><?= $uneTraversee['date'] ?></td>
							<td><?= $uneTraversee['heure'] ?></td>
							<td><?= $uneTraversee['nom'] ?></td>
						</tr>
					<?php
					}
				?>
			</tbody>
		</table>
	</div>
	<?php 
	} 
else {
	?>
	    <h1>Veuillez selectionner une liaison !</h1>
	<?php
    }
?>


