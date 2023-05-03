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
						<label class="control-label modal-label">NumT:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="num" required>
					</div>
				</div>

                
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Date:</label>
					</div>
					<div class="col-sm-10">
						<input type="file" class="form-control" name="date" >
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Heure:</label>
					</div>
					<div class="col-sm-10">
					<input type="file" class="form-control" name="heure" >
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Code_L:</label>
					</div>
					<div class="col-sm-10">
                    <input type="number" step="0.1" class="form-control" name="codeLiaison" required>
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Id_B:</label>
					</div>
					<div class="col-sm-10">
                    <input type="number" step="0.1" class="form-control" name="idBateau" required>
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
