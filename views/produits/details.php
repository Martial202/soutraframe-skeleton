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
                                <li class="breadcrumb-item"><a href="" class="retour">Commande</a>
                                </li>
                                <li class="breadcrumb-item active">Details
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- <h3 class="content-header-title mb-0">Print Datatable</h3> -->
                </div>
            </div>
            <div class="content-body">

                <!-- Disable auto print table -->
                <section id="disable-print">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Details Produit</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <span class="mr-2">
                                            <button type="button" class="btn btn-danger retour pull-right"><i class="feather icon-x"></i> Retour</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="card" style="border: 1px solid gray; border-radius: 15px;">
                                                <div class="card-content">
                                                    <div class="card-header card-title" style="border-radius: 15px;">
                                                        INFORMATION PRODUIT
                                                    </div>
                                                    <div class="card-body">
                                                        <!-- <span class="card-title px-5">info chambre regionnale</span><br> -->
                                                        <table class="pt-5">
                                                            <tr>
                                                                <td class="px-1">Code produit:</td>
                                                                <td class=""><b><?= @$detailsProducts['code_produit'] ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Libelle produit:</td>
                                                                <td class=""><b><?= @$detailsProducts['libelle_produit']  ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Prix unitaire:</td>
                                                                <td class=""><b><?= @$detailsProducts['prix_produit'] ?></b></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="card" style="border: 1px solid gray; border-radius: 15px;">
                                                <div class="card-content">
                                                    <div class="card-header card-title" style="border-radius: 15px;">
                                                        INFORMATION CATEGORIE
                                                    </div>
                                                    <div class="card-body">
                                                        <!-- <span class="card-title px-5">info chambre regionnale</span><br> -->
                                                        <table class="">
                                                            <tr>
                                                                <td class="px-1">Categoie :</td>
                                                                <td class=""><b><?= @$detailsProducts['libelle_categorie'] ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-1">Famille :</td>
                                                                <td class=""><b><?= @$detailsProducts['libelle_famille'] ?></b></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <div class="card" style="border: 1px solid gray; border-radius: 15px;">
                                                <div class="card-content">
                                                    <div class="card-title card-header" style="border-radius: 15px;">
                                                        DESCRIPTION :
                                                    </div>
                                                    <div class="card-body">
                                                        <span><?= @$detailsProducts['description_produit'] ?></span><br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row match-height">
                        <!-- active users card -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card active-users">
                                <div class="card-header border-0">
                                    <h4 class="card-title">Liste des images du produit</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php

                                        foreach ($allPicture as $image) {
                                            $base64 = base64_encode($image['image_data']); // encode en base64
                                            echo '
                                                <div class="col-md-3 col-sm-4 mb-2">
                                                    <div class="card shadow-sm border">
                                                        <img 
                                                            src="data:image/jpeg;base64,' . $base64 . '" 
                                                            class="card-img-top img-fluid img-thumbnail" 
                                                            style="height:200px; object-fit:cover;" 
                                                            alt="Image produit">
                                                    </div>
                                                </div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- active users and my task timeline cards ends here -->
                </section>
                <!--/ Disable auto print table -->


            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- footer -->
    <?php require_once '../public/inc/footer.php'; ?>