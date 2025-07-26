	<!-- header -->
	<?php require_once '../public/inc/header.php';  ?>

	<!-- BEGIN: Content-->
	<div class="app-content content">
		<div class="content-overlay"></div>
		<div class="content-wrapper">
			<div class="content-header row">
				<div class="content-header-left col-md-6 col-12 mb-2">
					<div class="row breadcrumbs-top">
						<div class="breadcrumb-wrapper col-12">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="" class="retour">Home</a>
								</li>
								<li class="breadcrumb-item active">Profil</a>
								</li>
								<!-- <li class="breadcrumb-item active">Account setting
								</li> -->
							</ol>
						</div>
					</div>
					<h3 class="content-header-title mb-0">Profil</h3>
				</div>
			</div>
			<div class="content-body">
				<!-- account setting page start -->
				<section id="page-account-settings">
					<div class="row">
						<!-- left menu section -->
						<div class="col-md-3 mb-2 mb-md-0">
							<ul class="nav nav-pills flex-column mt-md-0 mt-1">
								<li class="nav-item">
									<a class="nav-link d-flex active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
										<?= Validator::ficon('user'); ?>
										Infos personnelles
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link d-flex" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
										<i class="feather icon-lock"></i>
										Mot de passe
									</a>
								</li>

							</ul>
						</div>
						<!-- right content section -->
						<div class="col-md-9">
							<div class="card">
								<div class="card-content">
									<div class="card-body">
										<div class="tab-content">

											<!-- espace livreur -->
											<?php require_once '../views/users/pages/info_perso.php'; ?>
											<?php require_once '../views/users/pages/password.php'; ?>
											<!-- fin livreur  -->

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- account setting page end -->
			</div>
		</div>
	</div>
	<!-- END: Content-->

	<div class="sidenav-overlay"></div>
	<div class="drag-target"></div>



	<!-- footer -->
	<?php require_once '../public/inc/footer.php'; ?>