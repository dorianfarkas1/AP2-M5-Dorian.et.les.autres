
<!-- Add New -->
<div class="modal" tabindex="-1" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Ajouter un nouvel utilisateur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="?action=modifieUtil" enctype = "multipart/form-data">
            <div class="modal-body">
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Mail:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="mail_U" required>
					</div>
				</div>

                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Mdp:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="mdp_U" required>
					</div>
				</div>

                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Pseudo:</label>
					</div>
					<div class="col-sm-10">
                        <input type="text" class="form-control" name="pseudo_U" required>
					</div>
				</div>

                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Droits:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="droit" required>
					</div>
				</div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="bi bi-x-circle"></i> Annuler
                </button>
                <button type="submit" name="add" class="btn btn-primary">
                    <i class="bi bi-download"></i> Enregistrer
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
