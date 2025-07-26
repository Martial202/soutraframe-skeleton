<?php

class SettingController
{
    private $validator;
    private $home;

    // constructeur pour initialiser le validator ici, pour pouvoir l'utiliser dans toutes les méthodes de la classe AccueilController
    public function __construct()
    {
        $this->validator = new Validator();
        // $this->home = new ModelHome();
    }

    public function index() // la vue de la  connexion
    {
        $alllivreur = $this->validator->getAllByElementOrder("livreurs", "etat_livreur", 1, "id_livreur");
        $articlesBlog = $this->validator->getAllByElementOrder("actualite", "status_article", 1, "id");;
        require_once '../views/parametre/settings.php';
    }

    public function addLivreur() // add proprio
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fPost = Validator::sanitizeInput($_POST);
            $notEmpty = Validator::validateRequiredFields($fPost);
            if ($notEmpty === true) {
                if (!$this->validator->verif('livreurs', 'telephone',  $fPost['telephone'])) {
                    $data = [
                        "full_name" => $fPost['full_name'],
                        "telephone" => $fPost['telephone']
                    ];
                    // var_dump("colman",$data);return;
                    if ($this->validator->insert("livreurs", $data)) {
                        $msg = ['status' => 1, 'msg' => 'livreur ajoutée avec succès !!!'];
                    } else {
                        $msg = ['status' => 2, 'msg' => 'Erreur d\'insertion !!!'];
                    }
                } else {
                    $msg = ['status' => 2, 'msg' => 'Ce numero est déjà utilisé par un livreur']; // Affiche les erreurs ❌
                }
            } else {
                $msg = ['status' => 2, 'msg' => 'veuillez remplir tous les champs']; // Affiche les erreurs ❌
            }
            echo json_encode($msg);
        }
    }


    public function editLivreur() // editLivreur
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fPost = Validator::sanitizeInput($_POST);
            $notEmpty = Validator::validateRequiredFields($fPost);
            if ($notEmpty === true) {
                if (!$this->validator->_verif('livreurs', 'telephone',  $fPost['telephone'], 'id_livreur', $fPost['id_livreur'])) {
                    $data = [
                        "full_name" => $fPost['full_name'],
                        "telephone" => $fPost['telephone'],
                        "id_livreur" => $fPost['id_livreur']
                    ];
                    // var_dump("colman",$data);return;
                    if ($this->validator->update("livreurs", $data)) {
                        $msg = ['status' => 1, 'msg' => 'livreur Modifier avec succès !!!'];
                    } else {
                        $msg = ['status' => 2, 'msg' => 'Erreur de modification !!!'];
                    }
                } else {
                    $msg = ['status' => 2, 'msg' => 'Ce numero est déjà utilisé par un livreur']; // Affiche les erreurs ❌
                }
            } else {
                $msg = ['status' => 2, 'msg' => 'veuillez remplir tous les champs']; // Affiche les erreurs ❌
            }
            echo json_encode($msg);
        }
    }


    public function AddArticleBlog()
    {
        $msg = ['status' => 2, 'msg' => 'Une erreur est survenue.'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fPost = Validator::sanitizeInput($_POST);
            $notEmpty = Validator::validateRequiredFields($fPost);
            extract($fPost);

            if ($notEmpty === true) {
                if (!$this->validator->verif('actualite', 'titre', $titre)) {
                    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                        $tmpName = $_FILES['image']['tmp_name'];
                        $fileExt = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

                        $imageBlob = $this->validator->redimensionnerImageBlob($tmpName, 300, 300, $fileExt);

                        if ($imageBlob) {
                            $data = [
                                "titre" => $titre,
                                "image" => $imageBlob,
                                "extrait" => $extrait,
                                "contenu" => $contenu,
                                "date_publication" => date('Y-m-d H:i:s'),
                            ];

                            if ($this->validator->insert("actualite", $data)) {
                                $msg = ['status' => 1, 'msg' => 'Enregistrement effectué avec succès !'];
                            } else {
                                $msg = ['status' => 2, 'msg' => "Erreur d'insertion"];
                            }
                        } else {
                            $msg = ['status' => 2, 'msg' => "Erreur lors du redimensionnement de l'image."];
                        }
                    } else {
                        $msg = ['status' => 2, 'msg' => "L'image est requise ou invalide."];
                    }
                } else {
                    $msg = ['status' => 2, 'msg' => 'Cet article existe déjà !'];
                }
            } else {
                $msg = ['status' => 2, 'msg' => 'Veuillez renseigner tous les champs !'];
            }
        }

        echo json_encode($msg);
    }


    public function EditArticleBlog()
    {
        $msg = ['status' => 2, 'msg' => 'Une erreur est survenue.'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fPost = Validator::sanitizeInput($_POST);
            $notEmpty = Validator::validateRequiredFields($fPost, ['id_article', 'titre', 'extrait', 'contenu']); // id_article est requis ici
            extract($fPost);

            if ($notEmpty === true) {
                if (!$this->validator->_verif('actualite', 'titre', $titre, 'id', $id_article)) {
                    $data = [
                        "titre" => $titre,
                        "extrait" => $extrait,
                        "contenu" => $contenu,
                        "id" => $id_article,
                    ];

                    // Si une nouvelle image est fournie
                    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                        $tmpName = $_FILES['image']['tmp_name'];
                        $fileExt = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

                        $imageBlob = $this->validator->redimensionnerImageBlob($tmpName, 300, 300, $fileExt);

                        if ($imageBlob) {
                            $data['image'] = $imageBlob;
                        } else {
                            $msg = ['status' => 2, 'msg' => "Erreur lors du redimensionnement de l'image."];
                            echo json_encode($msg);
                            return;
                        }
                    }

                    if ($this->validator->update("actualite", $data)) {
                        $msg = ['status' => 1, 'msg' => 'Article modifié avec succès !'];
                    } else {
                        $msg = ['status' => 2, 'msg' => "Erreur lors de la mise à jour."];
                    }
                } else {
                    $msg = ['status' => 2, 'msg' => 'Un article avec ce titre existe déjà !'];
                }
            } else {
                $msg = ['status' => 2, 'msg' => 'Veuillez remplir tous les champs requis.'];
            }
        }

        echo json_encode($msg);
    }

    public function changeLivreur() // supprimer categorie
    {
        $msg = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            extract($_POST);
            if ($btn_changer == 1) {
                if ($this->validator->verif('livreurs', 'id_livreur', $id)) {
                    if ($this->validator->updateByElement('livreurs', 'etat_livreur', ITEM_SUPP, 'id_livreur', $id)) {
                        $msg = ["msg" => "Supression effectuée avec succès", 'status' => 1, "id" => $id];
                    } else {
                        $msg = ["msg" => 'Erreur de modification'];
                    }
                } else {
                    $msg = ["msg" => 'livreur introuvable!'];
                }
            } else {
                $msg = ["msg" => 'Une erreur est survenue! ']; // Affiche les erreurs ❌
            }
            echo json_encode($msg);
        }
    }

    public function changeBolg() // supprimer categorie
    {
        $msg = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            extract($_POST);
            if ($btn_changer == 1) {
                if ($this->validator->verif('actualite', 'id', $id)) {
                    if ($this->validator->updateByElement('actualite', 'status_article', ITEM_SUPP, 'id', $id)) {
                        $msg = ["msg" => "Supression effectuée avec succès", 'status' => 1, "id" => $id];
                    } else {
                        $msg = ["msg" => 'Erreur de modification'];
                    }
                } else {
                    $msg = ["msg" => 'Article introuvable!'];
                }
            } else {
                $msg = ["msg" => 'Une erreur est survenue! ']; // Affiche les erreurs ❌
            }
            echo json_encode($msg);
        }
    }


    // public function AddArticleBlog() // AddArticleBlog
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $fPost = Validator::sanitizeInput($_POST);
    //         $notEmpty = Validator::validateRequiredFields($fPost);
    //         extract($fPost);
    //         if ($notEmpty === true) {
    //             if (!$this->validator->verif('actualite', 'titre', $titre)) {
    //                 $data =
    //                     [
    //                         "titre" => $titre,
    //                         "extrait" => $extrait,
    //                         "contenu" => $contenu,
    //                         "date_publication" => date('Y-m-d H:i:s'),
    //                     ];
    //                 // var_dump("colman",$data);return;
    //                 if ($this->validator->insert("actualite", $data)) {
    //                     $msg = ['status' => 1, 'msg' => 'Enregistrement effectué avec succès !'];
    //                 } else {
    //                     $msg = ['status' => 2, 'msg' => "Erreur d'insertion"];
    //                 }
    //             } else {
    //                 $msg = ['status' => 2, 'msg' => 'Cette chambre regionale existe déjà !']; // Affiche les erreurs ❌
    //             }
    //         } else {
    //             $msg = ['status' => 2, 'msg' => 'Veuillez renseigner tous les champs!']; // Affiche les erreurs ❌
    //         }
    //         echo json_encode($msg);
    //     }
    // }

    // public function edit() // edit proprio
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $fPost = Validator::sanitizeInput($_POST);
    //         $notEmpty = Validator::validateRequiredFields($fPost);
    //         extract($fPost);
    //         if ($notEmpty === true) {
    //             if (!$this->validator->_verif('produits', 'libelle_produit', $libelle_produit, 'categorie_id', $categorie_id)) {
    //                 $data = [$libelle_produit, $qte_produit, $prix_produit, $description_produit, $categorie_id, $id_produit];
    //                 // var_dump("colman",$data);return;
    //                 if ($this->produit->updateProduit($data)) {
    //                     $msg = ['status' => 1, 'msg' => 'Modification effectué avec succès !'];
    //                 } else {
    //                     $msg = ['status' => 2, 'msg' => "Erreur d'insertion"];
    //                 }
    //             } else {
    //                 $msg = ['status' => 2, 'msg' => 'Cette chambre regionale existe déjà !']; // Affiche les erreurs ❌
    //             }
    //         } else {
    //             $msg = ['status' => 2, 'msg' => 'Veuillez renseigner tous les champs!']; // Affiche les erreurs ❌
    //         }
    //         echo json_encode($msg);
    //     }
    // }
}
