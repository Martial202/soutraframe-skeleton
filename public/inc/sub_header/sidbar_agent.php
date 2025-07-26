<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" navigation-header"><span>General</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="General"></i>
                </li>
                <li class=" nav-item"><a href="index.html"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge badge-primary badge-pill float-right mr-2"> 4</span></a>
                    <ul class="menu-content">
                        <li class="active"><a class="menu-item" href="<?= RACINE?>home" data-i18n="eCommerce">Dashboard pro</a>
                        </li>
                       

                    </ul>
                </li>

                <li class=" nav-item"><a href="#"><?=Validator::ficon('users'); ?> <span class="menu-title" data-i18n="Templates">Artisants</span></a>
                    <ul class="menu-content">
                        
                        <li>
                           
                        <a class="menu-item" href="<?=RACINE?>artisant/form" data-i18n="Vertical">  Ajouter</a>
                          
                        </li>

                    <li class=" nav-item"><a href="#"><?=Validator::ficon('list'); ?> <span class="menu-title" data-i18n="Templates">Liste</span></a>
                            <ul class="menu-content">
                                
                                <li>
                                
                                <a class="menu-item" href="<?=RACINE?>artisant/new_agent" data-i18n="Vertical">Nouveau</a>
                                
                                </li>
                                
                                <li>
                                
                                <a class="menu-item" href="<?=RACINE?>artisant/list_agent" data-i18n="Vertical">Historique</a>
                                
                                </li>
                                
                            </ul>
                    </li>

                        
                    </ul>
                </li>

                <li class=" nav-item"><a href="#"><?=Validator::icon('pencil'); ?> <span class="menu-title" data-i18n="Templates">Rapports</span></a>
                    <ul class="menu-content">
                        
                        <li>
                            
                        <a class="menu-item" href="<?=RACINE?>rapport/new" data-i18n="Vertical"><?=Validator::icon('copy'); ?> Nouveau rapport</a>
                          
                        </li>
                        <li>
                            
                        <a class="menu-item" href="<?=RACINE?>rapport/list_agent" data-i18n="Vertical"> <?=Validator::icon('book'); ?> Mes rapports</a>
                          
                        </li>
                        <li>
                            
                        <a class="menu-item" href="<?=RACINE?>rapport/versement" data-i18n="Vertical"> <?=Validator::icon('credit-card'); ?> Mes versements</a>
                          
                        </li>
                        
                    </ul>
                </li>

                <li class="btn btn-primary pull-right nav-item"><a href="<?= RACINE ?>user/profil"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Documentation">Mon Profil</span></a>
                </li>
            </ul>
        </div>
    </div>