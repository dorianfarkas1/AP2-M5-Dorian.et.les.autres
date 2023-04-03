
<?php
	include_once('BDD/connectBdd.php'); // cette page a besoin d'inclure le code qui crée l'objet PDO $connexion qui permet d'interroger la BDD

?>	
    <?php 
        $SQL = 'SELECT * FROM secteur'; 
        $stmt = $connexion->prepare($SQL);
        $stmt->execute(array()); // on passe dans le tableaux les paramètres si il y en a à fournir (aucun ici)
        $lesSecteurs = $stmt->fetchAll(PDO::FETCH_ASSOC); // on met le resultat de la requete dans un tableau
        //var_dump($lesLiaisons);
        $stmt->closeCursor(); // on ferme le curseur des résultats
    ?>

<h1 class="page-header text-center">Liaisons assurées par notre compagnie</h1>
<form method="post" action="index.php?action=liaison">
    <div>
        <label for="id">Choisir un destination  :</label>
        <select name="id">
		    <option value="">--sélectionner un secteur--</option>
			<?php
			foreach ($lesSecteurs as $unSecteur) {
				$selected = "";
				if ((isset($_POST['id'])) && ($_POST['id']==$unSecteur['codeSecteur'])) {
					$selected = "selected";
				}
				echo '<option value="'.$unSecteur['id'].'" '.$selected.'>'.$unSecteur['nom'].'</option>';
			}
			?>
	    </select>
    </div>
	<input type="submit" value="Afficher les liaison" title="Afficher les liaison" />
</form>

<br>

<?php
if ((isset($_POST['id'])) && ($_POST['id'] != "")){
	$codeSecteur = $_POST['id'];
	$SQL = "SELECT * FROM liaison JOIN secteur ON liaison.codeSecteur = secteur.id  WHERE secteur.id = ? ORDER BY secteur.nom ";
	$stmt = $connexion->prepare($SQL);
	$stmt->execute(array($codeSecteur)); // on passe dans le tableaux les paramètres si il y en a à fournir
	$lesLiaisons = $stmt->fetchAll();
} else {
	$SQL = "SELECT * FROM liaison JOIN secteur ON liaison.codeSecteur = secteur.id   ORDER BY secteur.nom";
	$stmt = $connexion->prepare($SQL);
	$stmt->execute(array()); // on passe dans le tableaux les paramètres si il y en a à fournir (aucun ici)
	$lesLiaisons = $stmt->fetchAll();
}?>

<div class="row">
	<table id="myTable" class="table table-bordered table-striped">
		<thead>
			<th>Port de Départ</th>
			<th>Port d'Arriver</th>
			<th>Distance</th>
			<th>Secteur</th>
		
		</thead>
		<tbody>
			<?php
				foreach ($lesLiaisons as $Liaison){
				?>
					<tr>
						<td><?= $Liaison['portDepart'] ?></td>
						<td><?= $Liaison['portArrivee'] ?></td>
						<td><?= $Liaison['distance'] ?></td>
						<td><?= $Liaison['nom'] ?></td>
					</tr>
				<?php
				}
			?>
		</tbody>
	</table>
</div>
