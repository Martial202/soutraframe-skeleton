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
                                <li class="breadcrumb-item"><a href="" class="retour">Livraison</a>
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
                                    <h4 class="card-title">Details LIVRAISON</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <?php
                                            if (!empty($status)) {
                                                if ($status == 1) {
                                                    echo '<b class="badge badge-success">Commande livrée</b>';
                                                } else {
                                                    echo '<b class="badge badge-danger">Commande annulée</b>';
                                                }
                                            }
                                            ?>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-12">
                                            <div class="card" style="border: 1px solid gray; border-radius: 15px;">
                                                <div class="card-content">
                                                    <div class="card-header card-title" style="border-radius: 15px;">
                                                        INFORMATION COMMANDE
                                                    </div>
                                                    <div class="card-body">
                                                        <!-- <span class="card-title px-5">info chambre regionnale</span><br> -->
                                                        <table class="pt-5">
                                                            <tr>
                                                                <td class="px-1">Reference:</td>
                                                                <td class=""><b><?= @$detailslivraison['ref_commande'] ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Montant:</td>
                                                                <td class=""><b><?= number_format(@$detailslivraison['montant_commande'], 0, ".", ",")  ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Date:</td>
                                                                <td class=""><b><?= @$detailslivraison['date_commande'] ?></b></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <div class="card" style="border: 1px solid gray; border-radius: 15px;">
                                                <div class="card-content">
                                                    <div class="card-header card-title" style="border-radius: 15px;">
                                                        INFORMATION LIVRAISON
                                                    </div>
                                                    <div class="card-body">
                                                        <!-- <span class="card-title px-5">info chambre regionnale</span><br> -->
                                                        <table class="pt-5">
                                                            <tr>
                                                                <td class="px-1">Reference:</td>
                                                                <td class=""><b><?= @$detailslivraison['code_livraison'] ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Date :</td>
                                                                <td class=""><b><?= @$detailslivraison['date_livraison'] ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Livreur:</td>
                                                                <td class=""><b><?= @$detailslivraison['full_name'] ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Tel Livreur:</td>
                                                                <td class=""><b><?= @$detailslivraison['telephone'] ?></b></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <div class="card" style="border: 1px solid gray; border-radius: 15px;">
                                                <div class="card-content">
                                                    <div class="card-header card-title" style="border-radius: 15px;">
                                                        INFORMATION CLIENT
                                                    </div>
                                                    <div class="card-body">
                                                        <!-- <span class="card-title px-5">info chambre regionnale</span><br> -->
                                                        <table class="">
                                                            <tr>
                                                                <td class="px-1">Client :</td>
                                                                <td class=""><b><?= @$detailslivraison['full_name_client'] ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Telephone :</td>
                                                                <td class=""><b><?= @$detailslivraison['telephone_client'] ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Lieu :</td>
                                                                <td class=""><b><?= @$detailslivraison['lieu_livraison'] ?></b></td>
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
                                                if (!empty($produitsOflivraison)) {
                                                    foreach ($produitsOflivraison as  $value) {
                                                        ++$i;
                                                        // $cryptedParams = $this->validator->crypter($value['id_versement']); 
                                                        $montant = $value['prix_produit'] * $value['qte_ligne'];
                                                        $total += $montant;
                                                ?>
                                                        <tr>
                                                            <td class="align-middle"><?= $i ?></td>
                                                            <td class="text-truncate align-middle">
                                                                <span class="text-truncate"><?= Validator::decodeTexteEntites($value['libelle_produit']) ?></span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <span><?= Validator::decodeTexteEntites($value['libelle_categorie']) ?></span>
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
                                            <button type="button" <?= @$detailslivraison['etat_livraison'] == 1 ? 'hidden'  : '' ?> data-toggle="modal" data-target="#addLivraison" class=" btn btn-primary pull-right"><i class="feather icon-truck"></i> Valider la livraison</button>
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
                    <h5 class="modal-title" id="modalTitle">Status de la livraison</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="form_check_Livraison">
                        <div class="form-group">
                            <label for="livraison_code">Code livraison:</label>
                            <div class="input-group">
                                <input type="text" readonly class="form-control" id="livraison_codes" name="livraison_codes" value="<?= @$detailslivraison['code_livraison'] ?>">
                                <div class="input-group-append">
                                </div>
                            </div>
                            <div class="error-message" id="livraison_codesError"></div>
                        </div>
                        <div class="form-group">
                            <label for="commande_code">Reference commande:</label>
                            <div class="input-group">
                                <input type="text" readonly class="form-control" id="commande_code" name="commande_code" value="<?= @$detailslivraison['ref_commande'] ?>">
                                <div class="input-group-append">
                                </div>
                            </div>
                            <div class="error-message" id="commande_codeError"></div>
                        </div>
                        <div class="form-group">
                            <label for="id_action">Choisir l'actions</label>
                            <div class="input-group">
                                <select class="form-control" id="id_action" name="id_action">
                                    <option value="">-- Sélectionner une action --</option>
                                    <option value="1">Commande livrée</option>
                                    <option value="2">Commande annulée</option>
                                </select>
                                <div class="input-group-append">
                                    <!-- <span class="input-group-text"><?= Validator::icon('u'); ?></span> -->
                                </div>
                            </div>
                            <div class="error-message" id="id_actionError"></div>
                        </div>
                        <div class="form-group">
                            <label for="motif">Commentaire:</label>
                            <div class="input-group">
                                <textarea name="motif" id="motif" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                            <div class="error-message" id="motifError"></div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAction = document.getElementById('id_action');
            const motif = document.getElementById('motif');
            const motifGroup = motif.closest('.form-group');

            // Masquer le champ au départ
            motifGroup.style.display = 'none';
            motif.removeAttribute('required');

            // Gérer l'affichage et validation
            selectAction.addEventListener('change', function() {
                if (this.value === '2') { // Commande annulée
                    motifGroup.style.display = 'block';
                    motif.setAttribute('required', 'required');
                } else {
                    motifGroup.style.display = 'none';
                    motif.removeAttribute('required');
                    motif.value = ''; // Vide le champ si besoin
                }
            });
        });
    </script>


    <!-- footer -->
    <?php require_once '../public/inc/footer.php'; ?>