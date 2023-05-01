
<h1 class="page-header text-center"><?= $title ?></h1>
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
