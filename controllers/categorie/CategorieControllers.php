<?php

class CategorieController
{
    private $validator;
    private $categorie;

    // constructeur pour initialiser le validator ici, pour pouvoir l'utiliser dans toutes les méthodes de la classe AccueilController
    public function __construct()
    {
        $this->validator = new Validator();
        $this->categorie = new ModelCategorie();
    }
    // page index de la categorie
    public function index($params = null) // la vue de la  connexion
    {
                // Valeurs par défaut pour le formulaire (ajout)
        $valueChampCategorie = "";
        $valueChampFamille = "";
        $valueChampIdFamille = "";
        $valueChampIdCategorie = "";
        $valueBouton = "Sauvegarder";
        $formClass = "form_add_categorie";

        // Si un paramètre est présent dans l'URL, on est en mode "modification"
        if (!empty($params)) {
            $id_categorie = $this->validator->decrypter($params); // Décrypte l'ID

            // Récupération des données de la categorie à modifier
            $data = $this->categorie->getCategorieByElement($id_categorie);

            // S'assurer que des données ont été trouvées
            if ($data) {
                $valueChampCategorie = $data['libelle_categorie'];
                $valueChampFamille = $data['libelle_famille'];
                $valueChampIdCategorie = $data['id_categorie'];
                $valueChampIdFamille = $data['famille_id'];
                $valueBouton = "Modifier";
                $formClass = "form_edit_categorie";
            }
        }

        $categories = $this->categorie->getAllCategorieOrder();
        $familles = $this->validator->getAllByElementOrder("famille", "status_famille", 1, "id_famille");
        require_once '../views/categorie/index.php';
    }

    public function change() // supprimer categorie
    {
        $msg = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            extract($_POST);
            if ($btn_changer == 1) {
                if ($this->validator->verif('categories', 'id_categorie', $id)) {
                    if ($this->validator->updateByElement('categories', 'status_categorie', ITEM_SUPP, 'id_categorie', $id)) {
                        $msg = ["msg" => "Supression effectuée avec succès", 'status' => 1, "id" => $id];
                    } else {
                        $msg = ["msg" => 'Erreur de modification'];
                    }
                } else {
                    $msg = ["msg" => 'categorie introuvable!'];
                }
            } else {
                $msg = ["msg" => 'Une erreur est survenue! ']; // Affiche les erreurs ❌
            }
            echo json_encode($msg);
        }
    }

    public function add() // add categorie
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fPost = Validator::sanitizeInput($_POST);
            // $notEmpty = Validator::validateRequiredFields($fPost);
            if (!empty($fPost['libelle_categorie']) || !empty($fPost['id_famille'])) {
                if (!$this->validator->verifs('categories', 'libelle_categorie', 'famille_id', $fPost['libelle_categorie'], $fPost['id_famille'])) {
                    // $data = [USER_ID, $fPost['role_id'], $fPost['nom_categorie'], $fPost['tel_categorie'], $fPost['password_categorie'], Validator::dateActuelle()];
                    // var_dump("colman",$data);return;
                    if ($this->categorie->addcategorie($fPost['libelle_categorie'], $fPost['id_famille'])) {
                        $msg = ["status" => 1, "msg" => 'categorie ajoutée avec succès !'];;
                    } else {
                        $msg = ["msg" => 'Erreur d\'insertion!'];
                    }
                } else {
                    $msg = ["msg" => 'Cette categorie existe dèjà dans la base']; // Affiche les erreurs ❌
                }
            } else {
                $msg = ["msg" => 'Veuillez renseigner tous les champs!']; // Affiche les erreurs ❌
            }
            echo json_encode($msg);
        }
    }

    public function edit() // edit
    {
        $msg = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fPost = Validator::sanitizeInput($_POST);
            $notEmpty = Validator::validateRequiredFields($fPost);
            extract($fPost);
            $libelle = $libelle_categorie;
            if ($notEmpty === true) {
                if (!$this->validator->verifs('categories', 'libelle_categorie', 'famille_id', $id_categorie, $id_famille)) {
                    $data = [$libelle, $id_famille, $id_categorie];
                    // var_dump("colman",$data);return;
                    if ($this->categorie->updatecategorie($data)) {
                        $msg = ["msg" => "Modification effectuée avec succès", 'status' => 1, "id" => $id_categorie];
                    } else {
                        $msg = ["msg" => 'Erreur de modification'];
                    }
                } else {
                    $msg = ["msg" => 'Ce numéro de téléphone existe déjà !']; // Affiche les erreurs ❌
                }
            } else {
                $msg =  ["msg" => 'Veuillez renseigner tous les champs!']; // Affiche les erreurs ❌
            }
            echo json_encode($msg);
        }
    }
    
}