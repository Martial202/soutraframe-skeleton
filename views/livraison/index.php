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
                                <li class="breadcrumb-item active">En cour
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
                                    <h4 class="card-title">Liste des livraisons recentes</h4>
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
                    <div class="row">
                        <?php
                        // var_dump($rapports);
                        if ($allLivraisons) {
                            foreach ($allLivraisons as $value) {
                                $cryptedParams = $this->validator->crypter($value['id_livraison']);
                        ?>
                                <div class="col-xl-4 col-lg-6 col-12 element-item " style="display: block;">
                                    <div class=" card">
                                        <div class="card-content ">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body text-left w-100">
                                                        <h4 class="primary">Nouvelle livraison</h4>
                                                        <span>code livraison: <b><?= $value['code_livraison'] ?></b></span><br>
                                                        <span>code commande: <b><?= $value['ref_commande'] ?></b></span><br>
                                                        <span>Date: <b><?= $value['date_livraison'] ?></b></span>
                                                    </div>
                                                </div>
                                                <div class=" mt-1 mb-0">
                                                    <a class="btn btn-success" href="<?= RACINE; ?>livraison/details/<?= $cryptedParams; ?>">Voir les details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        } else {
                            echo '<h3 class="text-danger ml-5 justify-content-center">Aucune commande pour l\'instant </h3>';
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