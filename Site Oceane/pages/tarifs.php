<?php
	include_once('BDD/connectBdd.php'); // cette page a besoin d'inclure le code qui crée l'objet PDO $connexion qui permet d'interroger la BDD

	
    $SQL = 'SELECT * FROM periode'; 
    $stmt = $connexion->prepare($SQL);
    $stmt->execute(array()); // on passe dans le tableaux les paramètres si il y en a à fournir (aucun ici)
    $lesPrix = $stmt->fetchAll(PDO::FETCH_ASSOC); // on met le resultat de la requete dans un tableau
    $stmt->closeCursor(); // on ferme le curseur des résultats
    //var_dump ($lesTarifs);
?>	
<h1 class="page-header text-center">Les tarifs</h1>

<form method="post" action="index.php?action=tarif">
    <div>
        <label for="id">Choix d'une période :</label>
        <select name="id">
		    <option value="">--sélectionner une période--</option>
			<?php
			foreach ($lesPrix as $unPrix) {
				$selected = "";
				if ((isset($_POST['idPeriode'])) && ($_POST['idPeriode']==$unPrix['idPeriode'])) {
					$selected = "selected";
				}
				echo '<option value="'.$unPrix['idPeriode'].'" '.$selected.'>'.$unPrix['libellePeriode'].'</option>';
			}
			?>
	    </select>
    </div>
	<input type="submit" value="Afficher les tarifs" title="Afficher les tarifs" />
</form>

<?php
if ((isset($_POST['id'])) && ($_POST['id'] != "")){
	$liaison = $_POST['id'];
	$SQL = "SELECT * FROM tarification NATURAL JOIN type_billet NATURAL JOIN categorie NATURAL JOIN periode WHERE idPeriode = ? ORDER BY tarif";
	$stmt = $connexion->prepare($SQL);
	$stmt->execute(array($liaison)); // on passe dans le tableaux les paramètres si il y en a à fournir
	$lesTarifs = $stmt->fetchAll();?>
	<div class="row">
		<table id="myTable" class="table table-bordered table-striped">
			<thead>
				<th>Catégorie</th>
				<th>Type de billet</th>
				<th>Tarif</th>
				<th>Période</th>
			</thead>
			<tbody>
            <?php
				foreach ($lesTarifs as $unTarif){
				?>
					<tr>
						<td><?= $unTarif['libelleCategorie'] ?></td>
						<td><?= $unTarif['libelleTypeBillet'] ?></td>
						<td><?= $unTarif['tarif'] ?></td>
						<td><?= $unTarif['libellePeriode'] ?></td>
					</tr>
				<?php
				}
			?>
			</tbody>
		</table>
	</div>
<?php } else {?>
	<h1> Veuillez sélectionner une période ! </h1>
<?php }?>


