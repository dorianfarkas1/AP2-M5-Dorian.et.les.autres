<!-- Add New -->
<div class="modal" tabindex="-1" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Ajouter un nouveau trajet</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="?action=modifieTrajet" enctype = "multipart/form-data">
            <div class="modal-body">
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Num_trajet :</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="num" required>
					</div>
				</div>

                
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Date_départ :</label>
					</div>
					<div class="col-sm-10">
						<input type="file" class="form-control" name="date" >
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Heure_départ:</label>
					</div>
					<div class="col-sm-10">
                    <textarea class="form-control" name="heure" required></textarea>
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">ID_navire:</label>
					</div>
					<div class="col-sm-10">
                    <input type="number" step="0.1" class="form-control" name="nom" required>
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
