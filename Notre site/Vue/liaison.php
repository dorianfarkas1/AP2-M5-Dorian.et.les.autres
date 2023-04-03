<h1 class="page-header text-center">Liaisons assurées par notre compagnie</h1>

<form method="post" action="index.php?action=liaison">
    <div>
        <label for="id">Choix d'une destinations :</label>
        <select name="id">
		    <option value="">--sélectionner une destination--</option>
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
	<input type="submit" value="Afficher les liaisons" title="Afficher les liaisons" />
</form>


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
