<?php
	include_once('BDD/connectBdd.php'); // cette page a besoin d'inclure le code qui crée l'objet PDO $connexion qui permet d'interroger la BDD

	
    $SQL = 'SELECT CONCAT(portDepart,"-", portArrivee,"(", nom,")") AS trajet, code FROM liaison l JOIN secteur s ON l.codeSecteur = s.id'; 
    $stmt = $connexion->prepare($SQL);
    $stmt->execute(array()); // on passe dans le tableaux les paramètres si il y en a à fournir (aucun ici)
    $lesTrajets = $stmt->fetchAll(PDO::FETCH_ASSOC); // on met le resultat de la requete dans un tableau
	$stmt->closeCursor(); // on ferme le curseur des résultats
?>	

<h1 class="page-header text-center">Les traversées</h1>
<form method="post" action="index.php?action=traversée">
    <div>
        <label for="id2">Choix d'une liaison :</label>
        <select name="id2">
		    <option value="">--sélectionner une liaison--</option>
			<?php
			foreach ($lesTrajets as $unTrajet) {
				$selected = "";
				if ((isset($_POST['code'])) && ($_POST['code']==$unTrajet['t.codeLiaison'])) {
					$selected = "selected";
				}
				echo '<option value="'.$unTrajet['code'].'" '.$selected.'>'.$unTrajet['trajet'].'</option>';
			}
			?>
		<div>
		<label for="date">Choix d'une date :</label>
			<?php $date = date("Y-m-d");// date par défaut aujourd'hui
			if (isset($_POST['date'])) {
			$date = $_POST['date']; // si on a sélectionné une date précédemment, on remplace la date du jour par celle-ci
			} ?>
		<input type="date" id="date" name="date" value="<?= $date ?>">
</div>
    </div>
	<input type="submit" value="Afficher les liaisons" title="Afficher les liaisons" />
</form>
<?php 
if ((isset($_POST['id2'])) && ($_POST['id2'] != "") && (isset($_POST['date'])) && ($_POST['date'] != "")){ 
	$trave = $_POST['id2'];
	$SQL = "SELECT * FROM traversee t JOIN liaison l ON t.codeLiaison = l.code JOIN bateau b ON t.idBateau = b.id WHERE l.code = ?";
	$stmt = $connexion->prepare($SQL);
	$stmt->execute(array($trave)); // on passe dans le tableaux les paramètres si il y en a à fournir
	$lesTraves = $stmt->fetchAll();
	//var_dump ($lesTraves);
	//var_dump ($date); 
	?>

	<div class="row">
		<table id="myTable" class="table table-bordered table-striped">
			<thead>
				<th>Numéro de traversée</th>
				<th>Date de départ</th>
				<th>Heure de départ</th>
				<th>Nom du navire</th>
			</thead>
			<tbody>
            <?php
				foreach ($lesTraves as $unTrave){
				?>
					<tr>
						<td><?= $unTrave['num'] ?></td>
						<td><?= $unTrave['date'] ?></td>
						<td><?= $unTrave['heure'] ?></td>
						<td><?= $unTrave['nom'] ?></td>
					</tr>
				<?php
				}
			?>
			</tbody>
		</table>
	</div>
<?php } else {?>
	<h1> Veuillez sélectionner une période et une date! </h1>
<?php }?>