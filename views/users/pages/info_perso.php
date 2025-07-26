<div class="tab-pane active" id="account-vertical-general" role="tabpanel" aria-labelledby="account-pill-general" aria-expanded="true">
    <div class="media">
        <div class="media-body mt-75">
            <!-- <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content">
                <span>
                    <button type="button" class="btn btn-secondary pull-right" data-toggle="modal" data-target="#adduser">
                        <i class="fa fa-user-plus"></i> Nouveau user
                    </button>
                </span>
            </div> -->
        </div>
    </div>
    <hr>

    <form id="form_edit_user" method="post" action="">
        <div class="row align-items-start mb-3">
            <!-- Nom & Prénom -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="font-weight-bold mb-1">Nom</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="nom_user"
                            name="nom_user" placeholder="Entrer le libellé de la famille" value="<?= USER_NAME ?? '' ?>">
                        <div class="input-group-append">
                            <span
                                class="input-group-text"><?= Validator::icon('user'); ?></span>
                        </div>
                    </div>
                    <div class="error-message" id="nom_userError"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="font-weight-bold mb-1">Prénom</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="prenom_user"
                            name="prenom_user" placeholder="Entrer le libellé de la famille" value="<?= USER_FIRSTNAME ?? '' ?>">
                        <div class="input-group-append">
                            <span
                                class="input-group-text"><?= Validator::icon('user'); ?></span>
                        </div>
                    </div>
                    <div class="error-message" id="prenom_userError"></div>
                </div>
            </div>
            <!-- Téléphone & Email -->
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label class="font-weight-bold mb-1">Téléphone</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="telephone_user"
                            name="telephone_user" placeholder="Entrer le libellé de la famille" value="<?= USER_PHONE ?? ''?>">
                        <div class="input-group-append">
                            <span
                                class="input-group-text"><?= Validator::icon('phone'); ?></span>
                        </div>
                    </div>
                    <div class="error-message" id="telephone_userError"></div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label class="font-weight-bold mb-1">Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" id="email_user"
                            name="email_user" placeholder="Entrer le libellé de la famille" value="<?= USER_EMAIL ?? ''?>">
                        <div class="input-group-append">
                            <span
                                class="input-group-text"><?= Validator::icon('envelope'); ?></span>
                        </div>
                    </div>
                    <div class="error-message" id="email_userError"></div>
                </div>
            </div>
            <!-- Boutons superposés alignés -->
            <div class="col-12 mt-3 flex justify-content-end">
                <div class="flex flex-row align-items-end">
                    <button type="submit" class="btn btn-primary btn_actions text-white mb-2">
                        <?= Validator::icon('edit'); ?> Modifier
                    </button>
                    <a href="javascript:history.back()" class="btn btn-outline-secondary ">
                        <i class="fa fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>

        <input type="hidden" name="id_user" value="<?= USER_ID ?? '' ?>">
    </form>
</div>