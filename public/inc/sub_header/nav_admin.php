  <!-- BEGIN: Header-->
  <nav
      class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-light bg-gradient-x-grey-blue">
      <div class="navbar-wrapper">
          <div class="navbar-header">
              <ul class="nav navbar-nav flex-row">
                  <li class="nav-item mobile-menu d-md-none mr-auto"><a
                          class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                              class="feather icon-menu font-large-1"></i></a></li>
                  <li class="nav-item"><a class="navbar-brand" href="<?=RACINE?>home">
                          <!-- <img class="brand-logo" alt="stack admin logo" src="<?=RACINE?>app-assets/images/logo/stack-logo.png"> -->
                          <!-- logo -->
                          <!-- logo -->
                          <!-- <h2 class="brand-text" style="position: relative; bottom:12px;">CNM-CI</h2> -->
                          <div class="logo">
                              <span class="buro">BURO</span>
                              <span class="store">STORE</span>
                          </div>
                      </a></li>
                  <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                          data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
              </ul>
          </div>
          <div class="navbar-container content">
              <div class="collapse navbar-collapse" id="navbar-mobile">
                  <ul class="nav navbar-nav mr-auto float-left">
                      <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                              href="#"><i class="feather icon-menu"></i></a></li>
                  </ul>
                  <ul class="nav navbar-nav float-right">
                      <!-- end messages -->
                      <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                              href="#" data-toggle="dropdown">
                              <span class="user-name"><?=USER_NAME .' '. USER_FIRSTNAME?></span>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="<?= RACINE ?>user/profil">
                                 <i class="feather icon-user"></i> Mon Profil
                              </a>
                              <!-- <a class="dropdown-item" href="#">
                                  <i class="feather icon-check-square"></i> Actions
                              </a> -->

                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="<?= RACINE ?>home/deconnexion">
                                  <i class="feather icon-power"></i> Déconnexion
                              </a>
                          </div>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </nav>
  <!-- END: Header-->