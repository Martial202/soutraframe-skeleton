<?php

class FamilleController
{
    private $validator;
    private $famille;

    // constructeur pour initialiser le validator ici, pour pouvoir l'utiliser dans toutes les méthodes de la classe AccueilController
    public function __construct()
    {
        $this->validator = new Validator();
        $this->famille = new ModelFamille();
    }
        // page index de la famille
    public function index($params = null)
    {
        // Valeurs par défaut pour le formulaire (ajout)
        $valueChamp = "";
        $valueChampId = "";
        $valueBouton = "Sauvegarder";
        $formClass = "form_add_famille";

        // Si un paramètre est présent dans l'URL, on est en mode "modification"
        if (!empty($params)) {
            $id_famille = $this->validator->decrypter($params); // Décrypte l'ID

            // Récupération des données de la famille à modifier
            $data = $this->validator->getByElement("famille", "id_famille", $id_famille);

            // S'assurer que des données ont été trouvées
            if ($data) {
                $valueChamp = $data['libelle_famille'];
                $valueChampId = $data['id_famille'];
                $valueBouton = "Modifier";
                $formClass = "form_edit_famille";
            }
        }

        // Toujours récupérer la liste des familles actives
        $familles = $this->validator->getAllByElementOrder("famille", "status_famille", 1, "id_famille");

        // Appel de la vue
        require_once '../views/famille/index.php';
    }

    public function change() // supprimer famille
    {
        $msg = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            extract($_POST);
            if ($btn_changer == 1) {
                if ($this->validator->verif('famille', 'id_famille', $id)) {
                    if ($this->validator->updateByElement('famille', 'status_famille', ITEM_SUPP, 'id_famille', $id)) {
                        $msg = ["msg" => "Supression effectuée avec succès", 'status' => 1, "id" => $id];
                    } else {
                        $msg = ["msg" => 'Erreur de modification'];
                    }
                } else {
                    $msg = ["msg" => 'famille introuvable!'];
                }
            } else {
                $msg = ["msg" => 'Une erreur est survenue! ']; // Affiche les erreurs ❌
            }
            echo json_encode($msg);
        }
    }

    public function add() // add famille
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fPost = Validator::sanitizeInput($_POST);
            // $notEmpty = Validator::validateRequiredFields($fPost);
            if (!empty($fPost['libelle_famille'])) {
                if (!$this->validator->verif('famille', 'libelle_famille', $fPost['libelle_famille'])) {
                    // $data = [USER_ID, $fPost['role_id'], $fPost['nom_famille'], $fPost['tel_famille'], $fPost['password_famille'], Validator::dateActuelle()];
                    // var_dump("colman",$data);return;
                    if ($this->famille->addfamille($fPost['libelle_famille'])) {
                        $msg = ["status" => 1, "msg" => 'famille ajoutée avec succès !'];;
                    } else {
                        $msg = ["msg" => 'Erreur d\'insertion!'];
                    }
                } else {
                    $msg = ["msg" => 'Cette famille existe dèjà dans la base']; // Affiche les erreurs ❌
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
            $libelle = $libelle_famille;
            if ($notEmpty === true) {
                if (!$this->validator->_verif('famille', 'libelle_famille', $libelle, 'id_famille', $id_famille)) {
                    $data = [$libelle, $id_famille];
                    // var_dump("colman",$data);return;
                    if ($this->famille->updatefamille($data)) {
                        $msg = ["msg" => "Modification effectuée avec succès", 'status' => 1, "id" => $id_famille];
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