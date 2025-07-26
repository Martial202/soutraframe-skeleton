<?php $currentPage = $_SERVER['REQUEST_URI']; ?>

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <hr>

            <!-- Dashboard -->
            <li class="nav-item <?= strpos($currentPage, '/home') !== false ? 'open' : '' ?>">
                <a href="index.html">
                    <?= Validator::icon('home'); ?>
                    <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
                <ul class="menu-content">
                    <li class="<?= strpos($currentPage, '/home') !== false ? 'active' : '' ?>">
                        <a class="menu-item" href="<?= RACINE ?>home" data-i18n="eCommerce">Tableau de bord</a>
                    </li>
                </ul>
            </li>

            <!-- Produits -->
            <li class="nav-item <?= strpos($currentPage, '/produit') !== false ? 'open' : '' ?>">
                <a href="#">
                    <?= Validator::icon('cubes'); ?>
                    <span class="menu-title" data-i18n="Templates">Produits</span>
                </a>
                <ul class="menu-content">
                    <li class="<?= strpos($currentPage, '/produit/liste') !== false ? 'active' : '' ?>">
                        <a class="menu-item" href="<?= RACINE ?>produit/liste" data-i18n="Vertical">
                            <?= Validator::icon('cube'); ?> Produits
                        </a>
                    </li>
                    <li class="<?= strpos($currentPage, '/produit/categorie') !== false ? 'active' : '' ?>">
                        <a class="menu-item" href="<?= RACINE ?>produit/categorie" data-i18n="Vertical">
                            <?= Validator::icon('tags'); ?> Catégories
                        </a>
                    </li>
                    <li class="<?= strpos($currentPage, '/produit/famille') !== false ? 'active' : '' ?>">
                        <a class="menu-item" href="<?= RACINE ?>produit/famille" data-i18n="Vertical">
                            <?= Validator::icon('sitemap'); ?> Familles
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Commandes -->
            <li class="nav-item <?= strpos($currentPage, '/commande') !== false ? 'open' : '' ?>">
                <a href="#">
                    <?= Validator::icon('shopping-cart'); ?>
                    <span class="menu-title" data-i18n="Templates">
                        Commandes
                        <div class="badge badge-pill badge-glow badge-success float-right mr-2 hidden newCommandeCount">
                        </div>
                    </span>

                </a>
                <ul class="menu-content">
                    <li class="<?= strpos($currentPage, '/commande/nouveau') !== false ? 'active' : '' ?>">
                        <a class="menu-item" href="<?= RACINE ?>commande/nouveau" data-i18n="Vertical">
                            <?= Validator::icon('plus-circle'); ?> Nouveau
                            <span class="badge badge-pill badge-glow badge-success dot-green hidden" id="dotNewCommande"> </span>
                        </a>
                    </li>
                    <li class="<?= strpos($currentPage, '/commande/historique') !== false ? 'active' : '' ?>">
                        <a class="menu-item" href="<?= RACINE ?>commande/historique" data-i18n="Vertical">
                            <?= Validator::icon('archive'); ?> Historique
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Livraison -->
            <li class="nav-item <?= strpos($currentPage, '/livraison') !== false ? 'open' : '' ?>">
                <a href="#">
                    <?= Validator::icon('truck'); ?>
                    <span class="menu-title" data-i18n="Templates">Livraison</span>
                </a>
                <ul class="menu-content">
                    <li class="<?= strpos($currentPage, '/livraison/nouveau') !== false ? 'active' : '' ?>">
                        <a class="menu-item" href="<?= RACINE ?>livraison/nouveau" data-i18n="Vertical">
                            <?= Validator::icon('clock'); ?> Livraison en cours
                        </a>
                    </li>
                    <li class="<?= strpos($currentPage, '/livraison/history') !== false ? 'active' : '' ?>">
                        <a class="menu-item" href="<?= RACINE ?>livraison/history" data-i18n="Vertical">
                            <?= Validator::icon('archive'); ?> Historique
                        </a>
                    </li>
                </ul>
            </li>
            <!-- devis -->
            <li class="nav-item <?= strpos($currentPage, '/devis') !== false ? 'open' : '' ?>">
                <a href="#">
                    <?= Validator::icon('file'); ?>
                    <span class="menu-title" data-i18n="Templates">Devis</span>
                    <div class="badge badge-pill badge-glow badge-success float-right mr-2 hidden newDevisCount">
                    </div>
                </a>
                <ul class="menu-content">
                    <li class="<?= strpos($currentPage, '/devis/nouveau') !== false ? 'active' : '' ?>">
                        <a class="menu-item" href="<?= RACINE ?>devis/nouveau" data-i18n="Vertical">
                            <?= Validator::icon('plus-circle'); ?> Demande
                            <span class="badge badge-pill badge-glow badge-success dot-green hidden" id="dotNewDevis"> </span>
                        </a>
                    </li>
                    <li class="<?= strpos($currentPage, '/devis/history') !== false ? 'active' : '' ?>">
                        <a class="menu-item" href="<?= RACINE ?>devis/history" data-i18n="Vertical">
                            <?= Validator::icon('archive'); ?> Historique
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Paramètres -->
            <li class="btn btn-primary mt-2 pull-right nav-item <?= strpos($currentPage, '/home/parametres') !== false ? 'active' : '' ?>">
                <a href="<?= RACINE ?>home/parametres">
                    <i class="feather icon-settings fa fa-spin"></i>
                    <span class="menu-title" data-i18n="Documentation">Paramètres</span>
                </a>
            </li>

        </ul>
    </div>
</div>