<!-- header -->
<?php require_once '../public/inc/header.php'; ?>
< <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="" class="retour">Commande</a>
                                </li>
                                <li class="breadcrumb-item active">Details
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- <h3 class="content-header-title mb-0">Print Datatable</h3> -->
                </div>
            </div>
            <div class="content-body">

                <!-- Disable auto print table -->
                <section id="disable-print">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Details Commande</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <!-- <span class="float-right mr-2"><?= $detailsRapport['status_rapport'] == 1 ?: '' ?> </span> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="card" style="border: 1px solid gray; border-radius: 15px;">
                                                <div class="card-content">
                                                    <div class="card-header card-title" style="border-radius: 15px;">
                                                        INFORMATION COMMANDE
                                                    </div>
                                                    <div class="card-body">
                                                        <!-- <span class="card-title px-5">info chambre regionnale</span><br> -->
                                                        <table class="pt-5">
                                                            <tr>
                                                                <td class="px-1">Reference commande:</td>
                                                                <td class=""><b><?= @$detailsCommande['ref_commande'] ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Montant commande:</td>
                                                                <td class=""><b><?= number_format(@$detailsCommande['montant_commande'], 0, ".", ",")  ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Date Commande:</td>
                                                                <td class=""><b><?= @$detailsCommande['date_commande'] ?></b></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="card" style="border: 1px solid gray; border-radius: 15px;">
                                                <div class="card-content">
                                                    <div class="card-header card-title" style="border-radius: 15px;">
                                                        INFORMATION CLIENT
                                                    </div>
                                                    <div class="card-body">
                                                        <!-- <span class="card-title px-5">info chambre regionnale</span><br> -->
                                                        <table class="">
                                                            <tr>
                                                                <td class="px-1">Nom & Prenom :</td>
                                                                <td class=""><b><?= @$detailsCommande['full_name_client'] ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Telephone :</td>
                                                                <td class=""><b><?= @$detailsCommande['telephone_client'] ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Lieu de livraison:</td>
                                                                <td class=""><b><?= @$detailsCommande['lieu_livraison'] ?></b></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- active users and my task timeline cards starts here -->
                    <div class="row match-height">
                        <!-- active users card -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card active-users">
                                <div class="card-header border-0">
                                    <h4 class="card-title">Liste des produits</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content m-2 pb-2">
                                    <div id="audience-list-scroll" class="table-responsive position-relative">
                                        <table class="table database-branche">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Produit</th>
                                                    <th>Categorie</th>
                                                    <th>Prix(u)</th>
                                                    <th>Quantité</th>
                                                    <th>Montant</th>
                                                    <!-- <th>Actions</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $i = 0;
                                                $total = 0;
                                                if (!empty($produitsOfCommande)) {
                                                    foreach ($produitsOfCommande as  $value) {
                                                        ++$i;
                                                        // $cryptedParams = $this->validator->crypter($value['id_versement']); 
                                                        $montant = $value['prix_produit'] * $value['qte_ligne'];
                                                        $total += $montant;
                                                ?>
                                                        <tr>
                                                            <td class="align-middle"><?= $i ?></td>
                                                            <td class="text-truncate align-middle">
                                                                <span class="text-truncate"><?= $value['libelle_produit'] ?></span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <span><?= $value['libelle_categorie'] ?></span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <span><?= $value['prix_produit'] ?></span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <span><?= $value['qte_ligne'] ?></span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <span><?= number_format($montant, 0, ".", ",")  ?></span>
                                                            </td>
                                                            <!-- <td class="align-middle">
                                                                <span class="badge badge-<?= $value['statut'] == 1 ? 'success' : 'danger' ?>"><?= $value['statut'] == 1 ? 'Success' : 'Echec' ?></span>
                                                            </td> -->
                                                            <!-- <td class="align-middle">
                                                                <div class="dropdown ">
                                                                    <span class="dropdown-toggle badge badge-primary p-1" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions
                                                                    </span>
                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                                        <a class="dropdown-item" href="<?= RACINE_2; ?>chambreController/details_agent/<?= $cryptedParams ?>">Details</a>
                                                                        <a class="dropdown-item" href="#">Desactiver</a>
                                                                    </div>
                                                                </div>
                                                                </span>
                                                            </td> -->
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>

                                            </tbody>
                                        </table>
                                        <br>
                                        <hr>
                                        <h3><span class="float-right">Total à Payer: <b><?= number_format($total, 0, ".", ",") ?></b> Fcfa</span></h3>
                                    </div>
                                    <hr>
                                    <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content">
                                        <span class="mr-2">
                                            <button type="button" class="btn btn-danger retour pull-right"><i class="feather icon-x"></i> Retour</button>
                                        </span>
                                        <span>
                                            <button type="button" <?= @$detailsCommande['etat_commande'] != 0 ? 'hidden'  : '' ?> data-toggle="modal" data-target="#addLivraison" class=" btn btn-primary pull-right"><i class="feather icon-truck"></i> Livrer la commande</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- active users and my task timeline cards ends here -->
                </section>
                <!--/ Disable auto print table -->


            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- Modal édition -->
    <div class="modal fade" id="addLivraison" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-center" role="document">
            <div class="modal-content">
                <div class="modal-header text-light" <?= BG_COLOR_VERT; ?>>
                    <h5 class="modal-title" id="modalTitle">Faire une livraison</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="form_add_Livraison">
                        <div class="form-group">
                            <label for="code_livraison">Code livraison:</label>
                            <div class="input-group">
                                <input type="text" readonly class="form-control" id="code_livraison" name="code_livraison" value="<?= @$codes ?>">
                                <div class="input-group-append">
                                    <!-- <span class="input-group-text"><?= Validator::icon('user'); ?></span> -->
                                </div>
                            </div>
                            <div class="error-message" id="code_livraisonError"></div>
                        </div>
                        <div class="form-group">
                            <label for="code_commande">Reference commande:</label>
                            <div class="input-group">
                                <input type="text" readonly class="form-control" id="code_commande" name="code_commande" value="<?= @$detailsCommande['ref_commande'] ?>">
                                <div class="input-group-append">
                                    <!-- <span class="input-group-text"><?= Validator::icon('user'); ?></span> -->
                                </div>
                            </div>
                            <div class="error-message" id="code_commandeError"></div>
                        </div>
                        <div class="form-group">
                            <label for="id_livreur">Choisir le livreur</label>
                            <div class="input-group">
                                <select class="form-control" id="id_livreur" name="id_livreur">
                                    <option value="">-- Sélectionner un livreur --</option>
                                    <?php foreach ($livreurs as $livreur): ?>
                                        <option value="<?= $livreur['id_livreur']; ?>">
                                            <?= htmlspecialchars($livreur['full_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                    <!-- <span class="input-group-text"><?= Validator::icon('u'); ?></span> -->
                                </div>
                            </div>
                            <div class="error-message" id="id_livreurError"></div>
                        </div>

                        <!--  -->
                        <div class="form-actions d-flex justify-content-between">
                            <button type="submit" class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer">Sauvegarder</button>
                            <button type="button" class="btn btn-secondary ml-1" data-dismiss="modal"><?= Validator::icon("close") ?> Fermer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- footer -->
    <?php require_once '../public/inc/footer.php'; ?>