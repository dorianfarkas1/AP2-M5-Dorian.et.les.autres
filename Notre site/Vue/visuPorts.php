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