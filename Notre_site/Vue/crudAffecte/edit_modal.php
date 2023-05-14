<!-- Edit -->
<div class="modal" tabindex="-1" id="edit_<?php echo $row['num']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Affecter un bateau</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="?action=affecterBateau">
            <div class="modal-body">
                <div class="row form-group">
                    <div class="row form-group">
					    <div class="col-sm-2">
						    <label class="control-label modal-label">Bateau:</label>
					    </div>
                        <div class="col-sm-10">
                            <select name="bateau" class="form-control" required> 
                                <option value="">--- Choisissez un bateau à affecter ---</option>
                                    <?php 
                                        foreach($lesBateaux as $unBateau) 
                                        {
                                    ?> 
                                        <option value="<?= $unBateau["id"] ?>" ><?= ucfirst($unBateau["nom"]) ?></option>
                                    
                                    <?php } ?> 
                            </select>
					    </div>
                    </div>
                    <div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label modal-label">Traversée:</label>
						</div>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="trav" value="<?php echo $row['num']; ?>">
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