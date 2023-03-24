<?php
	include_once('BDD/connectBdd.php'); // cette page a besoin d'inclure le code qui crée l'objet PDO $connexion qui permet d'interroger la BDD

	
    $SQL = 'SELECT * FROM secteur ORDER BY nom'; 
    $stmt = $connexion->prepare($SQL);
    $stmt->execute(array()); // on passe dans le tableaux les paramètres si il y en a à fournir (aucun ici)
    $lesVoyages = $stmt->fetchAll(PDO::FETCH_ASSOC); // on met le resultat de la requete dans un tableau
    $stmt->closeCursor(); // on ferme le curseur des résultats
    //var_dump ($lesLiaisons);
?>	
	
<h1 class="page-header text-center">Liaisons assurées par notre compagnie</h1>

<form method="post" action="index.php?action=liaison">
    <div>
        <label for="id">Choix d'une destinations :</label>
        <select name="id">
		    <option value="">--sélectionner une destination--</option>
			<?php
			foreach ($lesVoyages as $unVoyage) {
				$selected = "";
				if ((isset($_POST['id'])) && ($_POST['id']==$unVoyage['codeSecteur'])) {
					$selected = "selected";
				}
				echo '<option value="'.$unVoyage['id'].'" '.$selected.'>'.$unVoyage['nom'].'</option>';
			}
			?>
	    </select>
    </div>
	<input type="submit" value="Afficher les liaisons" title="Afficher les liaisons" />
</form>

<?php
if ((isset($_POST['id'])) && ($_POST['id'] != "")){
	$liaison = $_POST['id'];
	$SQL = "SELECT * FROM liaison l JOIN secteur s ON l.codeSecteur = s.id WHERE s.id = ? ORDER BY s.nom";
	$stmt = $connexion->prepare($SQL);
	$stmt->execute(array($liaison)); // on passe dans le tableaux les paramètres si il y en a à fournir
	$lesLiaisons = $stmt->fetchAll();
} else {
	$SQL = "SELECT * FROM liaison l JOIN secteur s ON l.codeSecteur = s.id ORDER BY s.nom";
	$stmt = $connexion->prepare($SQL);
	$stmt->execute(array()); // on passe dans le tableaux les paramètres si il y en a à fournir (aucun ici)
	$lesLiaisons = $stmt->fetchAll();
}?>

<div class="row">
		<table id="myTable" class="table table-bordered table-striped">
			<thead>
				<th>Port de départ</th>
				<th>Port d'arrivée</th>
				<th>Distance</th>
				<th>Secteur</th>
			</thead>
			<tbody>
            <?php
				foreach ($lesLiaisons as $uneLiaison){
				?>
					<tr>
						<td><?= $uneLiaison['portDepart'] ?></td>
						<td><?= $uneLiaison['portArrivee'] ?></td>
						<td><?= $uneLiaison['distance'] ?></td>
						<td><?= $uneLiaison['nom'] ?></td>
					</tr>
				<?php
				}
			?>
			</tbody>
		</table>
	</div>