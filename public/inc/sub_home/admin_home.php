    <?php require_once '../public/inc/header.php'; ?>

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Grouped multiple cards for statistics starts here -->
                <div class="row grouped-multiple-statistics-card">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                        <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                            <span class="card-icon warning d-flex justify-content-center mr-3">
                                                <i class="feather icon-users font-large-2 customize-icon font-large-2 p-1"></i>
                                            </span>
                                            <div class="stats-amount mr-3">
                                                <h3 class="heading-text text-bold-600"><?= $artisantProcess ?? 0; ?></h3>
                                                <p class="sub-heading">Artisant(s) Encours de validation</p>
                                            </div>
                                            <span class="inc-dec-percentage">
                                                <small class="success"><a href="<?=RACINE; ?>artisant/list_agent"><i class="fa fa-eye"></i></a> </small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                        <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                            <span class="card-icon warning d-flex justify-content-center mr-3">
                                                <i class="feather icon-credit-card font-large-2 customize-icon font-large-2 p-1"></i>
                                            </span>
                                            <div class="stats-amount mr-3">
                                                <h3 class="heading-text text-bold-600"><?= number_format($amountProcess ?? 0, 0, '.', ' '); ?> fcfa </h3>
                                                <p class="sub-heading">Montant Encours de validation</p>
                                            </div>
                                            <span class="inc-dec-percentage">
                                                <small class="danger"><a href="<?=RACINE; ?>rapport/versement"><i class="fa fa-eye"></i></a> </small>
                                            </span>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                        <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                            <span class="card-icon primary d-flex justify-content-center mr-3">
                                                <i class="feather icon-users font-large-2 customize-icon font-large-2 p-1"></i>
                                            </span>
                                            <div class="stats-amount mr-3">
                                                <h3 class="heading-text text-bold-600"><?= $artisantCollected ?? 0; ?></h3>
                                                <p class="sub-heading">Artisant(s) collecté(s)</p>
                                            </div>
                                            <span class="inc-dec-percentage">
                                                <small class="success"><a href="<?=RACINE; ?>artisant/list_agent"><i class="fa fa-eye"></i></a> </small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                        <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                            <span class="card-icon success d-flex justify-content-center mr-3">
                                                <i class="feather icon-credit-card font-large-2 customize-icon font-large-2 p-1"></i>
                                            </span>
                                            <div class="stats-amount mr-3">
                                                <h3 class="heading-text text-bold-600"><?= number_format($amountCollected ?? 0, 0, '.', ' '); ?> fcfa </h3>
                                                <p class="sub-heading">Montant Collecté</p>
                                            </div>
                                            <span class="inc-dec-percentage">
                                                <small class="danger"><a href="<?=RACINE; ?>rapport/versement"><i class="fa fa-eye"></i></a> </small>
                                            </span>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                        <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                            <span class="card-icon primary d-flex justify-content-center mr-3">
                                                <i class="feather icon-users font-large-2 customize-icon font-large-2 p-1"></i>
                                            </span>
                                            <div class="stats-amount mr-3">
                                                <h3 class="heading-text text-bold-600"> <?= $totalAgent??0 ?> </h3>
                                                <p class="sub-heading">Nos Agents</p>
                                            </div>
                                            <span class="inc-dec-percentage">
                                                <small class="success"><a href="<?=RACINE; ?>agent/list"><i class="fa fa-eye"></i></a> </small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 col-sm-6 col-12">
                                        <div class="d-flex align-items-start">
                                            <span class="card-icon secondary d-flex justify-content-center mr-3">
                                                <i class="feather icon-book font-large-2 customize-icon font-large-2 p-1"></i>
                                            </span>
                                            <div class="stats-amount mr-3">
                                                <h3 class="heading-text text-bold-600"><?= $rapportMaked ?? 0; ?></h3>
                                                <p class="sub-heading">Nos rapports</p>
                                            </div>
                                            <span class="inc-dec-percentage">
                                                <small class="danger"><a href="<?=RACINE; ?>rapport/list"><i class="fa fa-eye"></i></a> </small>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Grouped multiple cards for statistics ends here -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
	<?php require_once '../public/inc/footer.php'; ?>
