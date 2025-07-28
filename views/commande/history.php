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
                            <li class="breadcrumb-item"><a href="" class="retour">Commande</a></li>
                            <li class="breadcrumb-item active">Nouveau</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <!-- Disable auto print table -->
            <section id="disable-print">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Liste des commandes récentes</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Champ de recherche -->
                <div class="users-list-filter px-1 mb-2">
                    <div class="row border border-light rounded py-2">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <label for="search-contacts">Recherche :</label>
                            <div class="position-relative">
                                <input type="search" id="search-contacts" class="form-control" placeholder="Rechercher tous les artisans ici...">
                                <div class="form-control-position">
                                    <i class="fa fa-search text-size-base text-muted la-rotate-270"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cartes de commandes -->
                <div class="row" id="commande-liste">
                    <?php
                    if ($oldCommandes) {
                        foreach ($oldCommandes as $value) {
                            $cryptedParams = $this->validator->crypter($value['id_commande']);
                            $actions = $this->validator->getByElementItem("statut_livraison", "actions", "commande_ref", $value['ref_commande']);

                            $retVal = '';
                            if (isset($actions)) {
                                if ($actions == 1) {
                                    $retVal = '<h6 class="text-success">(Livrée)</h6>';
                                } elseif ($actions == 2) {
                                    $retVal = '<h6 class="text-danger">(Annulée)</h6>';
                                }
                            };
                    ?>
                            <div class="col-xl-4 col-lg-6 col-12 element-item" style="display: block; position: relative;">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body position-relative">

                                            <!-- Bouton imprimer rond -->
                                            <a href="<?= RACINE; ?>commande/imprimer/<?= $cryptedParams; ?>"
                                                class="btn btn-sm btn-primary rounded-circle d-flex align-items-center justify-content-center shadow"
                                                target="_blank"
                                                style="position: absolute; top: 10px; right: 10px; width: 35px; height: 35px; z-index: 10;"
                                                title="Imprimer">
                                                <?= Validator::ficon("printer fa-lg") ?>
                                            </a>

                                            <!-- Contenu de la commande -->
                                            <div class="media">
                                                <div class="media-body text-left w-100">
                                                    <h4 class="primary">Commande traitée<?= $retVal ?></h4>
                                                    <span>Client: <b><?= $value['full_name_client'] ?></b></span><br>
                                                    <span>Téléphone: <b><?= $value['telephone_client'] ?></b></span><br>
                                                    <span>Date: <b><?= $value['date_commande'] ?></b></span>
                                                </div>
                                            </div>

                                            <div class="mt-1 mb-0">
                                                <a class="btn btn-secondary" href="<?= RACINE; ?>commande/details/<?= $cryptedParams; ?>">
                                                    Voir détails
                                                </a>
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

<!-- ✅ Script de filtrage -->
<!-- <script>
    document.getElementById('search-contacts').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const cards = document.querySelectorAll('.element-item');

        cards.forEach(card => {
            const text = card.textContent.toLowerCase();
            card.style.display = text.includes(query) ? 'block' : 'none';
        });
    });
</script> -->

<!-- footer -->
<?php require_once '../public/inc/footer.php'; ?>