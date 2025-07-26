<?php require_once '../public/inc/header.php'; ?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Liste des commandes recentes</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <span>
                                        <button type="button" class="btn btn-success pull-right"> <?= Validator::ficon('money'); ?> 
                                        <h3>Recette: <b><?= number_format($totalAmountOfDay, 0, '.', ' ') ?> Fcfa</b></h3>
                                    </button>
                                    </span>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row grouped-multiple-statistics-card">
                <div class="col-12">
                    <!-- BEGIN: Additional Statistics Section -->
                    <div class="row grouped-multiple-statistics-card mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Statistique du jour</h4>
                                    <span>
                                        
                                    </span>
                                    <hr>
                                    <div class="row">
                                        <!-- Commandes du jour : Nouvelles -->
                                        <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                                <span class="card-icon info d-flex justify-content-center mr-3">
                                                    <i class="feather icon-shopping-cart font-large-2 p-1"></i>
                                                </span>
                                                <div class="stats-amount mr-3">
                                                    <h3 class="heading-text text-bold-600"><?= $commandeofDay ?? 0 ?></h3>
                                                    <p class="sub-heading">Commande </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Commandes du jour : Livrées -->
                                        <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                            <div class="d-flex align-items-start mb-sm-1 mb-xl-0">
                                                <span class="card-icon success d-flex justify-content-center mr-3">
                                                    <i class="feather icon-check font-large-2 p-1"></i>
                                                </span>
                                                <div class="stats-amount mr-3">
                                                    <h3 class="heading-text text-bold-600"><?= $commandeLivreofDay ?? 0 ?></h3>
                                                    <p class="sub-heading">Livrées </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <!-- Commandes du jour : Annulées -->
                                        <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                                <span class="card-icon danger d-flex justify-content-center mr-3">
                                                    <i class="feather icon-x font-large-2 p-1"></i>
                                                </span>
                                                <div class="stats-amount mr-3">
                                                    <h3 class="heading-text text-bold-600"><?= $commandeAnnuleofDay ?? 0 ?></h3>
                                                    <p class="sub-heading">Annulées </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Commandes du jour : En cours -->
                                        <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                            <div class="d-flex align-items-start ">
                                                <span class="card-icon warning d-flex justify-content-center mr-3">
                                                    <i class="feather icon-clock font-large-2 p-1"></i>
                                                </span>
                                                <div class="stats-amount mr-3">
                                                    <h3 class="heading-text text-bold-600"><?= $commandeEnCourofDay ?? 0 ?></h3>
                                                    <p class="sub-heading">En cours </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- <div class="row">
                                        <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                                <span class="card-icon warning d-flex justify-content-center mr-3">
                                                    <i class="feather icon-dollar-sign font-large-2 p-1"></i>
                                                </span>
                                                <div class="stats-amount mr-3">
                                                    <h3 class="heading-text text-bold-600"><?= $todayEncours ?? 0 ?></h3>
                                                    <p class="sub-heading">Montant prévu </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                            <div class="d-flex align-items-start">
                                                <span class="card-icon success d-flex justify-content-center mr-3">
                                                    <i class="feather icon-dollar-sign font-large-2 p-1"></i>
                                                </span>
                                                <div class="stats-amount mr-3">
                                                    <h3 class="heading-text text-bold-600"><?= $todayEncours ?? 0 ?></h3>
                                                    <p class="sub-heading">Montant rentré </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Additional Statistics Section -->

                    <!-- Totaux -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Total Nouvelles -->
                                <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                    <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                        <span class="card-icon info d-flex justify-content-center mr-3">
                                            <i class="feather icon-shopping-cart font-large-2 p-1"></i>
                                        </span>
                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600"><?= $commandeTotal ?? 0 ?></h3>
                                            <p class="sub-heading">Total Commande</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Livrées -->
                                <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                    <div class="d-flex align-items-start ">
                                        <span class="card-icon success d-flex justify-content-center mr-3">
                                            <i class="feather icon-check font-large-2 p-1"></i>
                                        </span>
                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600"><?= $commandeLivreTotal ?? 0 ?></h3>
                                            <p class="sub-heading">Total Commande livrées</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <!-- Total Annulées -->
                                <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                    <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                        <span class="card-icon danger d-flex justify-content-center mr-3">
                                            <i class="feather icon-x font-large-2 p-1"></i>
                                        </span>
                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600"><?= $commandeAnnuleTotal ?? 0 ?></h3>
                                            <p class="sub-heading">Total Commande annulées</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total En cours -->
                                <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                    <div class="d-flex align-items-start">
                                        <span class="card-icon warning d-flex justify-content-center mr-3">
                                            <i class="feather icon-dollar-sign font-large-2 p-1"></i>
                                        </span>
                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600"><?= number_format($totalAmount, 0, '.', ' ') ?> Fcfa</h3>
                                            <p class="sub-heading">Solde Total</p>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end row -->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once '../public/inc/footer.php'; ?>