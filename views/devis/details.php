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
                                        <div class="col-lg-12 col-12">
                                            <div class="card" style="border: 1px solid gray; border-radius: 15px;">
                                                <div class="card-content">
                                                    <div class="card-header card-title" style="border-radius: 15px;">
                                                        INFORMATION DEMANDEUR(SE)
                                                    </div>
                                                    <div class="card-body">
                                                        <!-- <span class="card-title px-5">info chambre regionnale</span><br> -->
                                                        <table class="pt-5">
                                                            <tr>
                                                                <td class="px-1">Société:</td>
                                                                <td class=""><b><?= @$detailsDevis['societe'] ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Demandeur(se):</td>
                                                                <td class=""><b><?= @$detailsDevis['civilite'] . ' ' . @$detailsDevis['full_name'] ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Telephone:</td>
                                                                <td class=""><b><?= @$detailsDevis['telephone'] ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Email:</td>
                                                                <td class=""><b><?= @$detailsDevis['email'] ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Date Livraison:</td>
                                                                <td class=""><b><?= @$detailsDevis['delai_livraison'] ?></b></td>
                                                            </tr>
                                                            <tr class="<?= (@$detailsDevis['fichier'] != null) ? '' : 'hidden' ?>">
                                                                <td class="px-1">
                                                                    Pièce jointe :
                                                                    <b>Il y a un document en pièce jointe</b>
                                                                </td>
                                                                <td>


                                                                    <div class="flex space-x-2 mt-2">
                                                                        <!-- Bouton Télécharger -->
                                                                        <a href="<?=RACINE_EXTERNE.$detailsDevis['fichier_chemin'] ?>"
                                                                            download="<?= @$detailsDevis['fichier'] ?>"
                                                                            class="btn btn-primary btn-sm">
                                                                            <i class="feather icon-download"></i> Télécharger
                                                                        </a>

                                                                        <!-- Bouton Imprimer -->
                                                                        <a href="<?= RACINE_EXTERNE.$detailsDevis['fichier_chemin'] ?>"
                                                                            class="btn btn-secondary btn-sm"
                                                                            id="btn-print-pdf"
                                                                            data-fichier="<?= RACINE_EXTERNE.$detailsDevis['fichier_chemin'] ?>">
                                                                            <i class="feather icon-printer"></i> Imprimer
                                                                        </a>

                                                                    </div>
                                                                </td>
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
                                    <h4 class="card-title">description DU DEVIS</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content m-2 pb-2">
                                    <div id="audience-list-scroll" class="table-responsive position-relative">
                                        <textarea class="form-control" name="" id="" rows="20" cols=""><?= @$detailsDevis['message'] ?></textarea>
                                    </div>
                                    <hr>
                                    <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content">
                                        <span class="mr-2">
                                            <button type="button" class="btn btn-danger retour pull-right"><i class="feather icon-x"></i> Retour</button>
                                        </span>
                                        <span>
                                            <button type="button" <?= @$detailsDevis['etat_devis'] != 0 ? 'hidden'  : '' ?> onclick="changeDeleteById('devisControllers/marqueOk', <?= @$detailsDevis['id_devis'] ?>)" class=" btn btn-primary pull-right"><i class="feather icon-check"></i> Marquez traiter</button>
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
    <script>
        document.getElementById('btn-print-pdf').addEventListener('click', function(e) {
            e.preventDefault();
            const fichierURL = this.getAttribute('data-fichier');

            // Ouvre directement le fichier PDF dans un nouvel onglet (aucun HTML de ton site n'est inclus)
            const printWindow = window.open(fichierURL, '_blank');

            if (!printWindow) {
                alert("Veuillez autoriser les fenêtres pop-up pour imprimer le document.");
                return;
            }

            // Petite pause pour que le PDF soit bien chargé avant d'imprimer
            printWindow.onload = function() {
                setTimeout(() => {
                    printWindow.focus();
                    printWindow.print();
                }, 800); // délais en ms
            };
        });
    </script>

    <!-- Modal édition -->


    <!-- footer -->
    <?php require_once '../public/inc/footer.php'; ?>