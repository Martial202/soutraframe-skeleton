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
                                <li class="breadcrumb-item"><a href="" class="retour">Devis</a>
                                </li>
                                <li class="breadcrumb-item active">Historique
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- <h3 class="content-header-title mb-0">Print Datatable</h3> -->
                </div>
                <!-- <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary dropdown-toggle dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings icon-left"></i> Settings</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item" href="card-bootstrap.html">Bootstrap Cards</a><a class="dropdown-item" href="component-buttons-extended.html">Buttons Extended</a></div>
                        </div><a class="btn btn-outline-primary" href="full-calender-basic.html"><i class="feather icon-mail"></i></a><a class="btn btn-outline-primary" href="timeline-center.html"><i class="feather icon-pie-chart"></i></a>
                    </div>
                </div> -->
            </div>
            <div class="content-body">

                <!-- Disable auto print table -->
                <section id="disable-print">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Liste des devis</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <!-- <span>
                                                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addChambreModal"> <?= Validator::ficon('home'); ?> Nouvelle Chambre</button>
                                            </span> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Champ de recherche -->
                    <div class="users-list-filter px-1 mb-2">
                        <div class="row border border-light rounded py-2">
                            <div class="col-12 col-sm-6 col-lg-12">
                                <label for="search-devis">Recherche :</label>
                                <div class="position-relative">
                                    <input type="search" id="search-devis" class="form-control" placeholder="Rechercher tous les artisans ici...">
                                    <div class="form-control-position">
                                        <i class="fa fa-search text-size-base text-muted la-rotate-270"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cartes de devis -->
                    <div class="row" id="devis-liste">
                        <?php
                        // var_dump($rapports);
                        if ($oldDevis) {
                            foreach ($oldDevis as $value) {
                                $cryptedParams = $this->validator->crypter($value['id_devis']);
                        ?>
                                <div class="col-xl-4 col-lg-6 col-12 devis-item element-item " style="display: block;">
                                    <div class=" card">
                                        <div class="card-content ">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body text-left w-100">
                                                        <h4 class="primary">Demande de devis</h4>
                                                        <span>Client: <b><?= $value['full_name'] ?></b></span><br>
                                                        <span>Société: <b><?= $value['societe'] ?></b></span><br>
                                                        <span>Telephone: <b><?= $value['telephone'] ?></b></span><br>
                                                        <span>Date: <b><?= $value['date_created'] ?></b></span>
                                                    </div>
                                                </div>
                                                <div class=" mt-1 mb-0">
                                                    <a class="btn btn-secondary" href="<?= RACINE; ?>devis/details/<?= $cryptedParams; ?>">Devis traité</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        } else {
                            echo '<h3 class="text-danger ml-5 justify-content-center">Aucun Devis pour l\'instant </h3>';
                        }
                        ?>
                    </div>

                    <div class="row justify-content-center mt-2">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-separate pagination-flat" id="paginationControls"></ul>
                        </nav>
                    </div>
                </section>
                <!--/ Disable auto print table -->


            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- footer -->
    <?php require_once '../public/inc/footer.php'; ?>