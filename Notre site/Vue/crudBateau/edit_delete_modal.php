<!-- Edit -->
<div class="modal" tabindex="-1" id="edit_<?php echo $row['id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modifier un bateau</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="?action=modifieBateau" enctype="multipart/form-data">
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
                    <?php if ($row['photo']!=""){  ?>
                        <div class="row form-group">
                            <div class="col-sm-10">
                            <img height='100px' src='images/bateaux/<?= $row['photo'] ?>'>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <input type="hidden" class="form-control" name="old_photo" value="<?php echo $row['photo']; ?>">
                    <div class="row form-group">
                        <div class="col-sm-2">
                            <label class="control-label modal-label">Photo:</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="photo">
                        </div>
                    </div>
                    <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label modal-label">Description :</label>
                            </div>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control" required rows="5" cols="33"><?php echo $row['description']; ?></textarea>
                            </div>
                    </div>
                    <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label modal-label">Longueur :</label>
                            </div>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control" required rows="5" cols="33"><?php echo $row['longueur']; ?></textarea>
                            </div>
                    </div>
                    <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label modal-label">Largeur :</label>
                            </div>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control" required rows="5" cols="33"><?php echo $row['largeur']; ?></textarea>
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
<div class="modal" tabindex="-1" id="delete_<?php echo $row['id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Supprimer un bateau</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
				<p class="text-center">Etes-vous sûr de vouloir supprimer le bateau <?php echo $row['nom']; ?> ?</p>
            </div>
            <div class="modal-footer">
				<form method="POST" action="?action=modifieBateau">
					<input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" class="form-control" name="old_photo" value="<?php echo $row['photo']; ?>">
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