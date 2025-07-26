	<!-- header -->
	<?php require_once '../public/inc/header.php';  ?>

	<!-- BEGIN: Content-->
	<div class="app-content content">
	    <div class="content-overlay"></div>
	    <div class="content-wrapper">
	        <div class="content-header row">
	            <div class="content-header-left col-md-6 col-12 mb-2">
	                <div class="row breadcrumbs-top mb-2">
	                    <div class="breadcrumb-wrapper col-12">
	                        <ol class="breadcrumb">
	                            <li class="breadcrumb-item"><a href="" class="retour">Home</a>
	                            </li>
	                            <li class="breadcrumb-item"><a href="" class="retour">Produits</a>
	                            </li>
	                            <li class="breadcrumb-item active">Categorie
	                            </li>
	                        </ol>
	                    </div>
	                </div>
	                <h3 class="content-header-title mb-0">Enregister la categorie des produits</h3>
	            </div>
	        </div>
	        <div class="content-body">
	            <!-- account setting page start -->
	            <section id="page-account-settings">
	                <div class="row">
	                    <!-- left menu section -->
	                    <div class="col-md-4 mb-2 mb-md-0">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="card-header">
	                                    <h3>Ajouter une Categorie <i><?= Validator::icon('tags'); ?></i></h3>
	                                </div>
	                                <div class="card-body">
	                                    <form method="POST" class="<?=$formClass?>">
	                                        <div class="form-group">
	                                            <label for="libelle">Libellé categorie</label>
	                                            <div class="input-group">
	                                                <input type="hidden" id="id_categorie" name="id_categorie" value="<?=$valueChampIdCategorie?>">
	                                                <input type="text" class="form-control" id="libelle_categorie"
	                                                    name="libelle_categorie"
	                                                    placeholder="Entrer le libellé de la categorie" value="<?=$valueChampCategorie?>">
	                                                <div class="input-group-append">
	                                                    <span
	                                                        class="input-group-text"><?= Validator::icon('tags'); ?></span>
	                                                </div>
	                                            </div>
	                                            <div class="error-message" id="libelle_categorieError"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="id_famille">Choisir la famille</label>
	                                            <div class="input-group">
	                                                <select class="form-control" id="id_famille" name="id_famille">
														<?php if(empty($valueChampIdCategorie)){ ?>
	                                                    <option value="">-- Sélectionner une famille --</option>
														<?php }else{ ?>
														<option value="<?=$valueChampIdFamille ;?>">
	                                                        <?= htmlspecialchars($valueChampFamille); ?>
	                                                    </option>
														<?php } ?>
	                                                    <?php foreach ($familles as $famille): ?>
	                                                    <option value="<?= $famille['id_famille']; ?>">
	                                                        <?= htmlspecialchars($famille['libelle_famille']); ?>
	                                                    </option>
	                                                    <?php endforeach; ?>
	                                                </select>
	                                                <div class="input-group-append">
	                                                    <span
	                                                        class="input-group-text"><?= Validator::icon('sitemap'); ?></span>
	                                                </div>
	                                            </div>
	                                            <div class="error-message" id="id_familleError"></div>
	                                        </div>

	                                        <div class="form-actions d-flex justify-content-between">
	                                            <button type="submit"
	                                                class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer ">Sauvegarder</button>
	                                            <button type="reset" class="btn btn-secondary ml-1"
	                                                data-dismiss="modal">Annuler</button>
	                                        </div>
	                                    </form>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <!-- right content section -->
	                    <div class="col-md-8">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="card-body">
	                                    <div class="tab-content">
	                                        <!-- espace categorie -->
	                                        <?php require_once 'categoriepage.php'; ?>
	                                        <!-- fin categorie  -->
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