<!-- Add New -->
<div class="modal" tabindex="-1" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Ajouter un nouveau bateau</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="?action=CTRcrudBateau" enctype = "multipart/form-data">
            <div class="modal-body">
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Nom:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nom" required>
					</div>
				</div>

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
						<label class="control-label modal-label">Dscpt°:</label>
					</div>
					<div class="col-sm-10">
                    <textarea class="form-control" name="description" required><?= $row['description'] ?>></textarea>
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Longueur:</label>
					</div>
					<div class="col-sm-10">
                    <input type="number" step="0.1" class="form-control" name="longueur" min="0" value="<?= $row['longueur']?>" required>
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Largeur:</label>
					</div>
					<div class="col-sm-10">
                    <input type="number" step="0.1" class="form-control" name="largeur" min="0" value="<?= $row['largeur']?>" required>
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Vitesse_C:</label>
					</div>
					<div class="col-sm-10">
                    <input type="number" class="form-control" step="1" min="0" name="vitesse" value="<?= $row['vitesse_croisiere']?>"  required>
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
                                        $stmt1 = $connexion->prepare('SELECT * FROM niveau_accessibilite'); 
                                        $stmt1->execute(array()); 
                                        $lesNiveauPMRs = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($lesNiveauPMRs as $unNiveauPMR) 
                                    {
                                        $selected = "";

                                        if ($unNiveauPMR['idNiveau'] == $row['niveauPMR']){
                                        $selected = "selected";
                                        }
                                     ?> 
                                    <option value="<?= $unNiveauPMR["idNiveau"] ?>" <?= $selected ?>><?= ucfirst($unNiveauPMR["libelle"]) ?></option>
                                    
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
                                
                            foreach ($lesSecteurs as $unSecteur) 
                            {
                                
                        ?>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="secteurs[<?= $unSecteur["id"] ?>]">
                                <label class="form-check-label" for="secteurs[<?= $unSecteur["id"] ?>]"><?= $unSecteur["nom"] ?></label>
                            </div>

                        <?php } ?>

                    </fieldset>
					</div>

                    <?php

                            $req = $connexion->prepare('SELECT lettreCategorie, capaciteMax FROM contenance_bateau WHERE idBateau = :id');
                            $req->bindParam(':id', $row['id'], PDO::PARAM_INT);
                            $req->execute();
                            $lesContenances = $req->fetchAll(PDO::FETCH_ASSOC); // le tableau $lesContenances contient les id des categories et du nb de places renseignées pour ce bateau
                            /* on prépare un tableau avec comme clés les catégories et comme valeurs les nb de places */

                            $nbPlacesParCategorie = array();

                            foreach ($lesContenances as $uneContenance) {

                               $nbPlacesParCategorie[$uneContenance['lettreCategorie']] = $uneContenance['capaciteMax'];
                            }  
                        
                        $SQL = 'SELECT * FROM categorie';    
                        $stmt3 = $connexion->prepare('SELECT * FROM categorie');
                        $stmt3->execute(array());
                        $lesCategories = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                        ?>
                        <div class="form-group">
                        <?php

                        foreach ($lesCategories as $uneCategorie) { ?>

                        <label for="categories[<?= $uneCategorie["idCategorie"] ?>]">Nombre de <?= $uneCategorie["libelleCategorie"] ?> :</label>
                        <input type="number" step="1" min="0" class="form-control" name="categories[<?= $uneCategorie["idCategorie"] ?>]" value="<?= $nbPlacesParCategorie[$uneCategorie["idCategorie"]] ?>" required>

                        <?php } ?>
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
