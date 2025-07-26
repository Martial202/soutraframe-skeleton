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
                            <li class="breadcrumb-item active">Ajouter un produit
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
                                <h4 class="card-title">Ajouter un Produit </h4>
                                <!-- <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a> -->
                                <div class="heading-elements">
                                    <ul class="list-inline">
                                        <span>
                                            <a href="<?= RACINE ?>produit/liste" class="btn btn-primary pull-right"> <?= Validator::ficon('list'); ?> liste des produits</a>
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
                            <form class="formProduit" method="POST">
                                <div class="row">
                                    <!-- Libelle Produit -->
                                    <div class="col-md-6 form-group">
                                        <label for="nom">Libelle Produit :</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="libelle_produit" name="libelle_produit" placeholder="Entrer le libelle du produit">
                                        </div>
                                        <div class="error-message" id="libelle_produitError"></div>
                                    </div>

                                    <!-- Categorie -->
                                    <div class="col-md-6 form-group">
                                        <label for="select-option ">Categorie:</label>
                                        <div class="input-group">

                                            <select class="form-control" id="categorie_id" name="categorie_id">
                                                <option value="default" class="text-center">... Selectionnez une categorie ...</option>
                                                <?php
                                                foreach ($categories as $categorie) { ?>
                                                    <option value=" <?= $categorie['id_categorie']; ?>"> <?= $categorie['libelle_categorie']; ?> </option>

                                                <?php  } ?>
                                            </select>
                                            <!-- <span class="input-group-addon"> <?= Validator::icon('user-secret'); ?></span> -->
                                        </div>
                                        <div class="error-message" id="categorie_idError"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Prix unitaire -->
                                    <div class="col-md-4 form-group">
                                        <label for="prix_produit">Prix unitaire:</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="prix_produit" name="prix_produit" maxlength="10" placeholder="Entrer le prix unitaire ">
                                            <!-- <span class="input-group-text" id="networkLogo"></span> -->
                                            <!-- <span class="input-group-addon"> <?= Validator::icon('phone'); ?></span> -->
                                        </div>
                                        <div class="error-message" id="prix_produitError"></div>

                                    </div>

                                    <!-- Quantité -->

                                    <div class="col-md-4 form-group">
                                        <label for="qte_produit">Quantité :</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="qte_produit" name="qte_produit" placeholder="Entrer la quantité du produit">
                                            <!-- <span class="input-group-addon"> <?= Validator::icon('user'); ?></span> -->
                                        </div>
                                        <div class="error-message" id="qte_produitError"></div>
                                    </div>

                                    <!-- Code produit -->
                                    <div class="col-md-4 form-group">
                                        <label for="code_produit">Code Produit: </label>
                                        <div class="input-group">
                                            <input type="text" readonly value="<?=$codes?>" class="form-control" id="code_produit" name="code_produit">
                                            <!-- <span class="input-group-addon"><?= Validator::icon('lock'); ?></span> -->
                                        </div>
                                        <div class="error-message" id="code_produitError"></div>
                                    </div>
                                </div>
                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description_produit">Description: </label>
                                    <div class="">
                                        <textarea name="description_produit" class="form-control" id="description_produit"></textarea>
                                    </div>
                                    <div class="error-message" id="description_produitError"></div>
                                </div>

                                <!-- Pied de page -->
                                <div class="row form-group card-footer">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span type="button" class="btn btn-danger retour " data-dismiss="modal">Annuler</span>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary btn_actions">Sauvegarder</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- users list ends -->
        </div>
    </div>
</div>
<!-- END: Content-->
<!-- footer -->
<?php require_once '../public/inc/footer.php'; ?>