

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

        <input type="date" id="date" name="date" value="<?= $date ?>">

    </div>
	    <input type="submit" value="Afficher les traversées" title="Afficher les traversées" />
</form>

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

	<h1> Veuillez sélectionner une période et une date! </h1>
