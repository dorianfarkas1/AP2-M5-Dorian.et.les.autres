<h2 class="page-header text-center"><?= $title ?></h2>

<form method="post" action="index.php?action=afficheTarif">
    <div>
        <label for="id">Choix d'une période :</label>
        <select name="id">
		    <option value="">--sélectionner une période--</option>
			<?php
			foreach ($lesPeriodes as $unePeriode) {
				$selected = "";
				if ((isset($_POST['idPeriode'])) && ($_POST['idPeriode']==$unePeriode['idPeriode'])) {
					$selected = "selected";
				}
				echo '<option value="'.$unePeriode['idPeriode'].'" '.$selected.'>'.$unePeriode['libellePeriode'].'</option>';
			}
			?>
	    </select>
    </div>
	<input type="submit" value="Afficher les tarifs" title="Afficher les tarifs" />
</form>

<?php if ((isset($_POST['id'])) && ($_POST['id'] != "")){ ?>
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
<?php } 
else { ?>
	<h3> Veuillez selectionner la période ! </h3>
<?php }?>





