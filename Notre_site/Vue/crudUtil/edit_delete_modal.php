<!-- Edit -->
<div class="modal" tabindex="-1" id="edit_<?= str_replace(" ", "_", $row['pseudoU']); ?>">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modifier un utilisateur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="?action=modifieUtil">
            <div class="modal-body">
                <div class="row form-group">
					<input type="hidden" class="form-control" name="mail_U" value="<?php echo $row['mailU']; ?>">

					<div class="row form-group">
					    <div class="col-sm-2">
						    <label class="control-label modal-label">Mdp:</label>
					    </div>
					        <div class="col-sm-10">
						    <input type="text" class="form-control" name="Mdp_U" value="<?php echo $row['mdpU']; ?>" required>
					    </div>
				    </div>

                    <div class="row form-group">
					    <div class="col-sm-2">
						    <label class="control-label modal-label">Pseudo:</label>
					    </div>
					    <div class="col-sm-10">
                            <input type="text" class="form-control" name="pseudo_U" value="<?php echo $row['pseudoU']; ?>" required>
					    </div>
				    </div>

                    <div class="row form-group">
					    <div class="col-sm-2">
						    <label class="control-label modal-label">Droits:</label>
					    </div>
					    <div class="col-sm-10">
						    <input type="text" class="form-control" name="droit" value="<?php echo $row['Droits']; ?>" required>
					    </div>
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
<div class="modal" tabindex="-1" id="delete_<?= str_replace(" ", "_", $row['pseudoU']); ?>">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Supprimer un utilisateur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
				<p class="text-center">Etes-vous sure de vouloir supprimer l'utilisateur <?php echo $row['mailU']; ?></p>
            </div>
            <div class="modal-footer">
				<form method="POST" action="?action=modifieUtil">
					<input type="hidden" class="form-control" name="mail_U" value="<?php echo $row['mailU']; ?>">
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