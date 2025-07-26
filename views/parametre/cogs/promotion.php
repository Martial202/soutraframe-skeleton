<div class="tab-pane" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="true">
    <div class="media">
        <div class="media-body mt-75">
            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content">
                <span>
                    <button type="button" class="btn btn-secondary pull-right" data-toggle="modal" data-target="#addLivreur"><i class="feather icon-volume-2"></i> Nouveau Promo</button>
                </span>
            </div>
        </div>
    </div>
    <hr>
    <table class="table table-striped table-bordered datatable-commune">
        <thead>
            <tr>
                <th>N°</th>
                <th>NOM & PRENOM</th>
                <th>TELEHONE</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            if (!empty($alllivreur)) {
                foreach ($alllivreur as $value) {
                    ++$i;
                    $cryptedParams = $this->validator->crypter($value['id_livreur']); ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $value['full_name'] ?></td>
                        <td><?= $value['telephone']; ?></td>
                        <td>
                            <a type="button" class="badge badge-primary text-white"
                                data-id_livreur="<?= $value['id_livreur']; ?>"
                                data-full_name="<?= $value['full_name']; ?>"
                                data-telephone="<?= $value['telephone']; ?>"
                                data-toggle="modal"
                                data-target="#editLivreur">
                                <?= Validator::icon('edit'); ?> Modifier
                            </a>

                            <a onclick="changeDeleteById('livreurController/change',<?= $value['id_livreur']; ?>)" class="badge badge-danger text-white">
                                <?= Validator::icon('trash'); ?> Supprimer
                            </a>
                        </td>
                    </tr>
            <?php
                }
            } ?>
        </tbody>
    </table>
</div>

<!-- Modal ajout -->
<div class="modal fade" id="addLivreur" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-center" role="document">
        <div class="modal-content">
            <div class="modal-header text-light" <?= BG_COLOR_VERT; ?>>
                <h5 class="modal-title" id="modalTitle">Espace d'enregistrement</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form_add_livreur" method="POST">
                    <div class="col-12 px-0 flex-sm-row flex-column justify-content-start">
                        <div class="form-group">
                            <label for="full_name">Nom & Prenom du livreur:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="ex: Kouame Martial ">
                                <span class="input-group-addon"><?= Validator::icon('user'); ?></span>
                            </div>
                            <div class="error-message" id="full_nameError"></div>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Téléphone du livreur:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="ex: 0777515789 ">
                                <span class="input-group-addon"><?= Validator::icon('phone'); ?></span>
                            </div>
                            <div class="error-message" id="telephoneError"></div>
                        </div>
                    </div>
                    <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                        <button type="submit" class="btn btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer"><?= Validator::icon("plus") ?> Ajouter le livreur</button>
                        <button class="btn btn-secondary ml-50" data-dismiss="modal"><?= Validator::icon("close") ?> Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal édition -->
<div class="modal fade" id="editLivreur" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-center" role="document">
        <div class="modal-content">
            <div class="modal-header text-light" <?= BG_COLOR_VERT; ?>>
                <h5 class="modal-title" id="modalTitle">Espace de modification</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form_edit_Livreur">
                    <div class="form-group">
                        <label for="full_nameModif">Nom & Prénom du livreur:</label>
                        <div class="input-group">
                            <input type="hidden" id="id_livreur" name="id_livreur">
                            <input type="text" class="form-control" id="full_nameModif" name="full_name" placeholder="ex: Kouame Martial">
                            <div class="input-group-append">
                                <span class="input-group-text"><?= Validator::icon('user'); ?></span>
                            </div>
                        </div>
                        <div class="error-message" id="full_nameModifError"></div>
                    </div>
                    <div class="form-group">
                        <label for="telephoneModif">Téléphone du livreur:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="telephoneModif" name="telephone" placeholder="ex: 0777515789">
                            <div class="input-group-append">
                                <span class="input-group-text"><?= Validator::icon('phone'); ?></span>
                            </div>
                        </div>
                        <div class="error-message" id="telephoneModifError"></div>
                    </div>
                    <div class="form-actions d-flex justify-content-between">
                        <button type="submit" class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer">Sauvegarder</button>
                        <button type="button" class="btn btn-secondary ml-1" data-dismiss="modal"><?= Validator::icon("close") ?> Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT de modification -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#editLivreur').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id_livreur');
            var fullname = button.data('full_name');
            var phone = button.data('telephone');

            var modal = $(this);
            modal.find('#id_livreur').val(id);
            modal.find('#full_nameModif').val(fullname);
            modal.find('#telephoneModif').val(phone);
        });
    });


    // Appel direct
    // editLivreur();
</script>