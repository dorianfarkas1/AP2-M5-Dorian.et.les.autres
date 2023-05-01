
<h1 class="page-header text-center"><?= $title ?></h1>

<form method="post" action="index.php?action=afficheTraversee">
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
<?php
if (isset($lesTraversees)){ ?>
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