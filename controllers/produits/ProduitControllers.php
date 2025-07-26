<?php

class ProduitController
{
    private $validator;
    public $produit;

    // constructeur pour initialiser le validator ici, pour pouvoir l'utiliser dans toutes les méthodes de la classe AccueilController
    public function __construct()
    {
        $this->validator = new Validator();
        $this->produit = new ModelProduit();
    }

    // page index de la famille
    public function index()
    {
        $produits = $this->produit->getProduits();
        // Appel de la vue
        require_once '../views/produits/index.php';
    }

    public function ajouter()
    {
        $categories = $this->validator->getAllByElement("categories", "status_categorie", 1);
        $codes = $this->validator->generateCode("produits", "code_produit", "PROD", 5);
        require_once '../views/produits/ajouter.php';
    }

    public function modifier($params)
    {
        $id_produit = $this->validator->decrypter($params); // Décrypte l'ID
        $produits = $this->validator->getByElement("produits", "id_produit", $id_produit);
        $libelle_categorie = $this->validator->getByElementItem("categories", "libelle_categorie", "id_categorie", $produits['categorie_id']);
        $categories = $this->validator->getAllByElement("categories", "status_categorie", 1);
        // $codes = $this->validator->generateCode("produits", "code_produit", "PROD", 5);
        require_once '../views/produits/modifier.php';
    }

    public function add() // add proprio
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fPost = Validator::sanitizeInput($_POST);
            $notEmpty = Validator::validateRequiredFields($fPost);
            extract($fPost);
            if ($notEmpty === true) {
                if (!$this->validator->_verif('produits', 'libelle_produit', $libelle_produit, 'categorie_id', $categorie_id)) {
                    $data = [$code_produit, $libelle_produit, $qte_produit, $prix_produit, $description_produit, $categorie_id];
                    // var_dump("colman",$data);return;
                    if ($this->produit->addProduits($data)) {
                        $msg = ['status' => 1, 'msg' => 'Enregistrement effectué avec succès !'];
                    } else {
                        $msg = ['status' => 2, 'msg' => "Erreur d'insertion"];
                    }
                } else {
                    $msg = ['status' => 2, 'msg' => 'Cette chambre regionale existe déjà !']; // Affiche les erreurs ❌
                }
            } else {
                $msg = ['status' => 2, 'msg' => 'Veuillez renseigner tous les champs!']; // Affiche les erreurs ❌
            }
            echo json_encode($msg);
        }
    }

    public function edit() // edit proprio
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fPost = Validator::sanitizeInput($_POST);
            $notEmpty = Validator::validateRequiredFields($fPost);
            extract($fPost);
            if ($notEmpty === true) {
                if (!$this->validator->_verif('produits', 'libelle_produit', $libelle_produit, 'categorie_id', $categorie_id)) {
                    $data = [$libelle_produit, $qte_produit, $prix_produit, $description_produit, $categorie_id, $id_produit];
                    // var_dump("colman",$data);return;
                    if ($this->produit->updateProduit($data)) {
                        $msg = ['status' => 1, 'msg' => 'Modification effectué avec succès !'];
                    } else {
                        $msg = ['status' => 2, 'msg' => "Erreur d'insertion"];
                    }
                } else {
                    $msg = ['status' => 2, 'msg' => 'Cette chambre regionale existe déjà !']; // Affiche les erreurs ❌
                }
            } else {
                $msg = ['status' => 2, 'msg' => 'Veuillez renseigner tous les champs!']; // Affiche les erreurs ❌
            }
            echo json_encode($msg);
        }
    }


    public function addImage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produit_id = $_POST['produit_id'] ?? null;

            if (!$produit_id) {
                echo json_encode(['status' => 2, 'msg' => 'Produit non défini']);
                return;
            }

            if (!isset($_FILES['images'])) {
                echo json_encode(['status' => 2, 'msg' => 'Aucune image reçue']);
                return;
            }

            $files = $_FILES['images'];
            $nbImages = count($files['name']);
            $successCount = 0;

            for ($i = 0; $i < $nbImages; $i++) {
                if ($files['error'][$i] === UPLOAD_ERR_OK) {
                    $tmpName = $files['tmp_name'][$i];
                    $fileName = $files['name'][$i];
                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                    if (!in_array($fileExt, ['jpg', 'jpeg', 'png'])) {
                        continue; // ignore les formats non valides
                    }

                    // Redimensionne
                    $imageBlob = $this->validator->redimensionnerImageBlob($tmpName, 300, 300, $fileExt);

                    // Insertion en base
                    $data = [
                        'image_data' => $imageBlob,
                        'produit_id' => $produit_id
                    ];
                    if ($this->validator->insert("images", $data)) {
                        $successCount++;
                    }
                }
            }

            if ($successCount > 0) {
                echo json_encode(['status' => 1, 'msg' => "$successCount image(s) enregistrée(s) avec succès"]);
            } else {
                echo json_encode(['status' => 2, 'msg' => "Aucune image valide n'a été enregistrée"]);
            }
        }
    }




    public function details($params)
    {
        $id_produit = $this->validator->decrypter($params); // Décrypte l'ID
        $detailsProducts = $this->produit->getProduitByIds($id_produit);
        $allPicture = $this->validator->getAllByElement("images", "produit_id", $id_produit);
        // var_dump($allPicture);
        require_once '../views/produits/details.php';
    }

    public function change() // supprimer produit
    {
        $msg = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            extract($_POST);
            if ($btn_changer == 1) {
                if ($this->validator->verif('produits', 'id_produit', $id)) {
                    if ($this->validator->updateByElement('produits', 'status_produit', ITEM_SUPP, 'id_produit', $id)) {
                        $msg = ["msg" => "Supression effectuée avec succès", 'status' => 1, "id" => $id];
                    } else {
                        $msg = ["msg" => 'Erreur de modification'];
                    }
                } else {
                    $msg = ["msg" => 'produit introuvable!'];
                }
            } else {
                $msg = ["msg" => 'Une erreur est survenue! ']; // Affiche les erreurs ❌
            }
            echo json_encode($msg);
        }
    }
}
