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
<?php else {?>
	<h1> Veuillez sélectionner une période ! </h1>
<?php }?>


