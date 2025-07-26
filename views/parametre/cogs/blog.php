<div class="tab-pane" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="true">
    <div class="media">
        <div class="media-body mt-75">
            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content">
                <span>
                    <button type="button" class="btn btn-secondary pull-right" data-toggle="modal" data-target="#addArticle"><i class="feather icon-book-open"></i> Nouveau Article</button>
                </span>
            </div>
        </div>
    </div>
    <hr>
    <table class="table table-striped table-bordered datatable-commune">
        <thead>
            <tr>
                <th>N°</th>
                <th>TITRE</th>
                <th>EXTRAIT</th>
                <th>STATUS</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            if (!empty($articlesBlog)) {
                foreach ($articlesBlog as $value) {
                    ++$i;
                    $cryptedParams = $this->validator->crypter($value['id']);
                    $status = '<i class="text-success">Publié</i>';
                    if ($value['status_article'] == 0) {
                        $status = '<i class="text-danger">Retiré</i>';
                    }

            ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= Validator::truncateText2($value['titre'], 20) ?></td>
                        <td><?= Validator::truncateText2($value['extrait'], 20) ?></td>
                        <td><?= $status ?></td>
                        <td>
                            <a type="button" class="badge badge-primary text-white"
                                data-id_article="<?= $value['id']; ?>"
                                data-titre="<?= htmlspecialchars($value['titre'], ENT_QUOTES); ?>"
                                data-extrait="<?= htmlspecialchars($value['extrait'], ENT_QUOTES); ?>"
                                data-contenu="<?= htmlspecialchars($value['contenu'], ENT_QUOTES); ?>"
                                data-toggle="modal"
                                data-target="#editArticle">
                                <?= Validator::icon('edit'); ?>
                            </a>


                            <a onclick="changeDeleteById('blogController/change',<?= $value['id']; ?>)" class="badge badge-danger text-white">
                                <?= Validator::icon('trash'); ?>
                            </a>
                            <!-- <a onclick="changeDeleteById('livreurController/change',<?= $value['id']; ?>)" class="badge badge-secondary text-white">
                                <?= Validator::icon('eye'); ?>
                            </a> -->
                        </td>
                    </tr>
            <?php
                }
            } ?>
        </tbody>
    </table>
</div>

<!-- Modal ajout article -->
<div class="modal fade" id="addArticle" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-center" role="document">
        <div class="modal-content">
            <div class="modal-header text-light" <?= BG_COLOR_VERT; ?>>
                <h5 class="modal-title" id="addArticleLabel">Ajouter un article</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form_add_article" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="titre">Titre de l'article:</label>
                        <input type="text" class="form-control" id="titre" name="titre" placeholder="ex: Nouveauté chez Buro Store">
                        <div class="error-message" id="titreError"></div>
                    </div>
                    <div class="form-group">
                        <label for="extrait">Extrait (résumé court):</label>
                        <textarea class="form-control" id="extrait" name="extrait" rows="2" placeholder="Résumé de l'article..."></textarea>
                        <div class="error-message" id="extraitError"></div>
                    </div>
                    <div class="form-group">
                        <label for="contenu">Contenu complet:</label>
                        <textarea class="form-control" id="contenu" name="contenu" rows="5" placeholder="Contenu principal de l'article..."></textarea>
                        <div class="error-message" id="contenuError"></div>
                    </div>
                    <div class="form-group">
                        <label for="image">Image à la une:</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                        <div class="error-message" id="imageError"></div>
                    </div>
                    <div class="form-actions d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary"><?= Validator::icon("plus") ?> Ajouter</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Validator::icon("close") ?> Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal modification article -->
<div class="modal fade" id="editArticle" tabindex="-1" role="dialog" aria-labelledby="editArticleLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-center" role="document">
        <div class="modal-content">
            <div class="modal-header text-light" <?= BG_COLOR_VERT; ?>>
                <h5 class="modal-title" id="editArticleLabel">Modifier l'article</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form_edit_article" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="id_article" name="id_article">
                    <div class="form-group">
                        <label for="titreEdit">Titre de l'article:</label>
                        <input type="text" class="form-control" id="titreEdit" name="titre" placeholder="Titre...">
                        <div class="error-message" id="titreEditError"></div>
                    </div>
                    <div class="form-group">
                        <label for="extraitEdit">Extrait:</label>
                        <textarea class="form-control" id="extraitEdit" name="extrait" rows="2"></textarea>
                        <div class="error-message" id="extraitEditError"></div>
                    </div>
                    <div class="form-group">
                        <label for="contenuEdit">Contenu:</label>
                        <textarea class="form-control" id="contenuEdit" name="contenu" rows="5"></textarea>
                        <div class="error-message" id="contenuEditError"></div>
                    </div>
                    <div class="form-group">
                        <label for="imageEdit">Image (laisser vide si inchangée):</label>
                        <input type="file" class="form-control-file" id="imageEdit" name="image">
                        <div class="error-message" id="imageEditError"></div>
                    </div>
                    <div class="form-actions d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary"><?= Validator::icon("save") ?> Sauvegarder</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Validator::icon("close") ?> Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- SCRIPT de modification -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#editArticle').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);

            // Récupération des données
            var id = button.data('id_article');
            var titre = button.data('titre');
            var extrait = button.data('extrait');
            var contenu = button.data('contenu');

            // Injection dans le modal
            var modal = $(this);
            modal.find('#id_article').val(id);
            modal.find('#titreEdit').val(titre);
            modal.find('#extraitEdit').val(extrait);
            modal.find('#contenuEdit').val(contenu);
        });
    });
</script>