<!-- Edit -->
<div class="modal" tabindex="-1" id="edit_<?php echo $row['id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modifier un bateau</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="?action=modifieBateau">
            <div class="modal-body">
                <div class="row form-group">
					<input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">

					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label modal-label">Nom:</label>
						</div>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nom" value="<?php echo $row['nom']; ?>">
						</div>
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Longueur:</label>
					</div>
					<div class="col-sm-10">
                    <input type="number" step="0.1" class="form-control" name="longueur" min="0"  value="<?php echo $row['longueur']; ?>" required>
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Largeur:</label>
					</div>
					<div class="col-sm-10">
                    <input type="number" step="0.1" class="form-control" name="largeur" min="0"  value="<?php echo $row['largeur']; ?>" required>
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Vitesse :</label>
					</div>
					<div class="col-sm-10">
                        <input type="number" class="form-control" step="1" min="0" name="vitesse" value="<?php echo $row['vitesse_croisiere']; ?>" required>
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">NivPMR:</label>
					</div>
					<div class="col-sm-10">
                        <select name="PMR" class="form-control" required> 
                            <option value="">--- Choisissez un niveau de PMR ---</option>
                                <?php 

                                    foreach($lesNiveauPMRs as $unNiveauPMR) 
                                    {
                                ?> 
                                    <option value="<?= $unNiveauPMR["idNiveau"] ?>" ><?= ucfirst($unNiveauPMR["libelle"]) ?></option>
                                    
                                <?php } ?> 
                        </select>
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Secteur:</label>
					</div>
					
                    <div class="col-sm-10">
                        <fieldset class="form-control">

                            <?php

                                foreach ($lesSecteurs as $unSecteur){ 
                            ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="secteurs[<?= $unSecteur["id"] ?>]">
                                    <label class="form-check-label" for="secteurs[<?= $unSecteur["id"] ?>]"><?= $unSecteur["nom"] ?></label>
                                </div>

                            <?php } ?>

                        </fieldset>
				    </div>

                        <div class="form-group">
                            <?php

                                foreach ($lesCategories as $uneCategorie) { ?>

                                <label for="categories[<?= $uneCategorie["idCategorie"] ?>]">Nombre de <?= $uneCategorie["libelleCategorie"] ?> :</label>
                                <input type="number" step="1" min="0" class="form-control" name="categories[<?= $uneCategorie["idCategorie"] ?>]"  required>

                            <?php } ?>
				        </div>

				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
					<i class="bi bi-x-circle"></i> Annuler
                </button>
                <button type="submit" name="edit" class="btn btn-success">
					<i class="bi bi-download"></i> Enregistrer
                </button>
            </div>
        </form>
        </div>
    </div>
</div>


<!-- Delete -->
<div class="modal" tabindex="-1" id="delete_<?php echo $row['id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Supprimer un bateau</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
				<p class="text-center">Etes-vous sure de vouloir supprimer le bateau ? <?php echo $row['nom']; ?></p>
            </div>
            <div class="modal-footer">
				<form method="POST" action="?action=modifieBateau">
					<input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="old_photo" class="form-control" value="<?php echo $row['photo']; ?>">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
						<i class="bi bi-x-circle"></i> Annuler
					</button>
					<button type="submit" name="supr" class="btn btn-danger">
						<i class="bi bi-download"></i> Enregistrer
					</button>
				</form>
            </div>
        </div>
    </div>
</div>