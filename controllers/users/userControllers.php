<?php

class UserController
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
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $user = $_SESSION['admin'];
            require_once '../views/users/index.php'; // On inclut la vue d'accueil qui contient le code HTML
        } else {
            require_once '../views/auth/connexion.php';
        }
    }

    public function editPassword()
    {
        $msg = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            extract($_POST); // attend : id, current_password, new_password

            if (empty($id) || empty($current_password) || empty($new_password)) {
                echo json_encode(["msg" => "Veuillez remplir tous les champs.", "status" => 0]);
                return;
            }

            // Récupérer le mot de passe actuel depuis la base
            $user = $this->validator->getByElement('admin', 'id', $id); // ou 'id_admin' selon ta table

            if ($user && password_verify($current_password, $user['password'])) {
                // Hacher le nouveau mot de passe
                $newPassHash = password_hash($new_password, PASSWORD_BCRYPT);

                // Mise à jour
                $data = ['password' => $newPassHash, 'id' => $id];
                if ($this->validator->update('admin', $data)) {

                    // ✅ Déconnexion de l'utilisateur
                    session_unset();     // Supprime toutes les variables de session
                    session_destroy();   // Détruit la session

                    $msg = [
                        "msg" => "Mot de passe modifié avec succès. Vous allez être déconnecté.",
                        "status" => 1,
                        "logout" => true  // utile pour le JS
                    ];
                } else {
                    $msg = ["msg" => "Erreur lors de la mise à jour du mot de passe", "status" => 0];
                }
            } else {
                $msg = ["msg" => "Ancien mot de passe incorrect", "status" => 0];
            }

            echo json_encode($msg);
        }
    }



    // public function add() // add famille
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $fPost = Validator::sanitizeInput($_POST);
    //         // $notEmpty = Validator::validateRequiredFields($fPost);
    //         if (!empty($fPost['libelle_famille'])) {
    //             if (!$this->validator->verif('famille', 'libelle_famille', $fPost['libelle_famille'])) {
    //                 // $data = [USER_ID, $fPost['role_id'], $fPost['nom_famille'], $fPost['tel_famille'], $fPost['password_famille'], Validator::dateActuelle()];
    //                 // var_dump("colman",$data);return;
    //                 if ($this->famille->addfamille($fPost['libelle_famille'])) {
    //                     $msg = ["status" => 1, "msg" => 'famille ajoutée avec succès !'];;
    //                 } else {
    //                     $msg = ["msg" => 'Erreur d\'insertion!'];
    //                 }
    //             } else {
    //                 $msg = ["msg" => 'Cette famille existe dèjà dans la base']; // Affiche les erreurs ❌
    //             }
    //         } else {
    //             $msg = ["msg" => 'Veuillez renseigner tous les champs!']; // Affiche les erreurs ❌
    //         }
    //         echo json_encode($msg);
    //     }
    // }

    public function edit() // edit user
    {
        $msg = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fPost = Validator::sanitizeInput($_POST, 'email_user');
            $notEmpty = Validator::validateRequiredFields($fPost);

            // Vérifie l'email
            if (!$this->validator->isValidEmail($_POST['email_user'])) {
                $msg = ["msg" => 'Email incorrect !!!'];
                echo json_encode($msg);
                return; // 🛑 Arrête l'exécution ici
            }

            $email = $_POST['email_user'];
            extract($fPost);

            if ($notEmpty === true) {
                // Vérifie si l'email existe déjà pour un autre utilisateur
                if (!$this->validator->verifNew('admin', 'telephone', 'email', $telephone_user, $email, 'id', $id_user)) {
                    $data = [
                        'name'      => $nom_user,
                        'firstname' => $prenom_user,
                        'email'     => $email,
                        'telephone' => $telephone_user,
                        'id'        => $id_user
                    ];
                    if ($this->validator->update('admin', $data)) {
                        // Met à jour la session si l'utilisateur modifié est celui connecté
                        if (isset($_SESSION['admin']) && $_SESSION['admin']['id'] == $id_user) {
                            $_SESSION['admin']['nom'] = $nom_user;
                            $_SESSION['admin']['prenom'] = $prenom_user;
                            $_SESSION['admin']['email'] = $email;
                            $_SESSION['admin']['telephone'] = $telephone_user;
                        }
                        $msg = ["msg" => "Modification effectuée avec succès", 'status' => 1, "id" => $id_user];
                    } else {
                        $msg = ["msg" => 'Erreur de modification'];
                    }
                } else {
                    $msg = ["msg" => 'Cet email existe déjà !'];
                }
            } else {
                $msg = ["msg" => 'Veuillez renseigner tous les champs!'];
            }
            echo json_encode($msg);
        }
    }
}
