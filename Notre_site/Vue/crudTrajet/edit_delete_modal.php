<!-- Edit -->
<div class="modal" tabindex="-1" id="edit_<?php echo $row['num']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modifier un trajet</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="?action=modifieTrajet">
            <div class="modal-body">
                <div class="row form-group">
					<input type="hidden" class="form-control" name="num" value="<?php echo $row['num']; ?>">

					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label modal-label">Date:</label>
						</div>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nom" value="<?php echo $row['date']; ?>">
						</div>
					</div>
                    <div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label modal-label">Heure:</label>
						</div>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nom" value="<?php echo $row['heure']; ?>">
						</div>
					</div>
                    <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Liaison:</label>
					</div>
					<div class="col-sm-10">
                    <input type="number" step="0.1" class="form-control" name="longueur" min="0"  value="<?php echo $row['codeLiaison']; ?>" required>
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Bateau:</label>
					</div>
					<div class="col-sm-10">
                    <input type="number" step="0.1" class="form-control" name="longueur" min="0"  value="<?php echo $row['idBateau']; ?>" required>
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
<div class="modal" tabindex="-1" id="delete_<?php echo $row['num']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Supprimer un bateau</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
				<p class="text-center">Etes-vous sure de vouloir supprimer le trajet ? <?php echo $row['num']; ?></p>
            </div>
            <div class="modal-footer">
				<form method="POST" action="?action=modifieTrajet">
					<input type="hidden" class="form-control" name="num" value="<?php echo $row['num']; ?>">
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