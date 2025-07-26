<!-- header -->
<?php require_once '../public/inc/header.php'; ?>
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="" class="retour">Home</a>
                            </li>
                            <li class="breadcrumb-item active">liste des produits
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- <h3 class="content-header-title mb-0">Print Datatable</h3> -->
            </div>
        </div>
        <div class="content-body">
            <!-- users list start -->
            <section class="users-list-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header justify-content">
                                <h4 class="card-title">Liste des Produits</h4>
                                <!-- <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a> -->
                                <div class="heading-elements">
                                    <ul class="list-inline">
                                        <span>
                                            <a href="<?= RACINE ?>produit/ajouter" class="btn btn-primary pull-right"> <?= Validator::ficon('plus'); ?> Nouveau produit</a>
                                        </span>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="users-list-datatable" class="table datatable-commune table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Code</th>
                                            <th>Libelle</th>
                                            <th>Prix</th>
                                            <th>Qantité</th>
                                            <th>Categorie</th>
                                            <th>Images</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $i = 0;
                                        if (@$produits) {
                                            foreach ($produits as $produit) {
                                                $i++;
                                                $cryptedParams = $this->validator->crypter($produit['id_produit']);
                                        ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $produit['code_produit']; ?></td>
                                                    <td><?= Validator::decodeTexteEntites($produit['libelle_produit']); ?></td>
                                                    <td><?= $produit['prix_produit']; ?></td>
                                                    <td><?= $produit['qte_produit']; ?></td>
                                                    <td><?= Validator::decodeTexteEntites($produit['libelle_categorie']); ?></td>
                                                    <td><a class="badge badge-primary" data-toggle="modal" data-produit_id="<?= $produit['id_produit']; ?>" data-target="#addImages">add image</a></td>
                                                    <td class="align-middle">
                                                        <div class="dropdown ">
                                                            <span class="dropdown-toggle badge badge-secondary p-0.5" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions
                                                            </span>
                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="<?= RACINE_2; ?>produit/details/<?= $cryptedParams ?>"><?= Validator::icon('eye'); ?> Details</a>
                                                                <a class="dropdown-item" href="<?= RACINE_2; ?>produit/modifier/<?= $cryptedParams ?>"><?= Validator::icon('edit'); ?> Modifier</a>
                                                                <a onclick="changeDeleteById('produitController/change',<?= $produit['id_produit'] ?>)" class="dropdown-item">
                                                                    <?= Validator::icon('trash'); ?> Supprimer
                                                                </a>
                                                            </div>
                                                        </div>
                                                        </span>
                                                    </td>
                                                </tr>

                                        <?php }
                                        } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- users list ends -->
        </div>
    </div>
</div>

<!-- Modal ajout -->
<div class="modal fade" id="addImages" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-center" role="document">
        <div class="modal-content">
            <div class="modal-header text-light" <?= BG_COLOR_VERT; ?>>
                <h5 class="modal-title" id="modalTitle">Espace de modification</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form_add_image" method="POST" enctype="multipart/form-data">
                    <div class="col-12 px-0 flex-sm-row flex-column justify-content-start">
                        <div class="form-group">
                            <label for="images">Choisir ton fichier:</label>
                            <div class="input-group">
                                <input type="text" class="form-control hidden" id="produit_id" name="produit_id">
                                <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
                                <span class="input-group-addon"><?= Validator::icon('file'); ?></span>
                            </div>
                            <div class="error-message" id="imagesError"></div>
                        </div>
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
        $('#addImages').on('show.bs.modal', function(event) { // ici c'était '#editLivreur' => à corriger !
            var button = $(event.relatedTarget);
            var id = button.data('produit_id');

            var modal = $(this);
            modal.find('#produit_id').val(id);
        });
    });
</script>
// <!-- footer -->
<?php require_once '../public/inc/footer.php'; ?>