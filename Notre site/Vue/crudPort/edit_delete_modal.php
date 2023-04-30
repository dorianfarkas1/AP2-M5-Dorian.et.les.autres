
<!-- Edit -->
<div class="modal" tabindex="-1" id="edit_<?= str_replace(" ", "_", $row['nom_court']); ?>">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modifier un bateau</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="?action=CRTcrudPort">
            <div class="modal-body">
                <div class="row form-group">
					<input type="hidden" class="form-control" name="id" value="<?php echo $row['nom_court']; ?>">

					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label modal-label">Nom:</label>
						</div>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nom" value="<?php echo $row['nom']; ?>">
						</div>
					</div>
                    <div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label modal-label">Description:</label>
						</div>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="description" value="<?php echo $row['description']; ?>">
						</div>
					</div>
                    <div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label modal-label">Adresse:</label>
						</div>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="adresse" value="<?php echo $row['adresse']; ?>">
						</div>
					</div>

                    <?php if ($row['photo']!=""){
                    ?>
                        <div class="row form-group">
                            <div class="col-sm-10">
                            <img height='100px' src='images/ports/<?= $row['photo'] ?>'>
                            </div>
                        </div>
                    <?php
                    }
                    ?> 
                    <input type="hidden" name="old_photo" class="form-control" value="<?php echo $row['photo']; ?>">
                    <div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label modal-label">Photo:</label>
						</div>
						<div class="col-sm-10">
							<input type="file" class="form-control" name="photo" >
						</div>
					</div>

                    <div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label modal-label">Caméra:</label>
						</div>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="camera" value="<?php echo $row['camera']; ?>">
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
<div class="modal" tabindex="-1" id="delete_<?= str_replace(" ", "_", $row['nom_court']); ?>">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Supprimer un port</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
				<p class="text-center">Etes-vous sure de vouloir supprimer le port <?php echo $row['nom']; ?></p>
            </div>
            <div class="modal-footer">
				<form method="POST" action="?action=CRTcrudPort">
					<input type="hidden" class="form-control" name="id" value="<?php echo $row['nom_court']; ?>">
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