<?php

require_once '../models/Validator.php';
class AuthController
{
    private $validator;
    private $user;

    public function __construct() // constructeur
    {
        $this->validator = new Validator();
        // $this->user = new modelUser();
    }

    
    public function decon() // vue de deconnexion
    {
        require_once '../views/users/decon.php';
    }

    public function index() // la vue de la  connexion
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            require_once '../views/acceeil/index.php'; // On inclut la vue d'accueil qui contient le code HTML
        } else {
            require_once '../views/auth/connexion.php';
        }
    }

    public function connexion() // add connexion
    {
        $msg = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $notEmpty = Validator::validateRequiredFields($_POST);

            if ($notEmpty === true) {
                extract($_POST);

                // Vérifier si l'email existe et obtenir les données de l'utilisateur

                $user = $this->validator->getByElement('admin', 'telephone', $tel);
                // $msg = ["msg"=>$agent];echo json_encode($msg);return;
                // $mdp = Validator::hashPassword($password);
                if (isset($user) && !empty($user) && password_verify($password, $user['password'])) {
                // if (isset($user) && !empty($user) && $password == $user['password']) {
                      $_SESSION['admin'] =
                            [ // Stocker les informations dans la session (tu peux stocker ce que tu veux)
                                'id' => $user['id'], // Exemple d'id utilisateur
                                'nom' => $user['name'],     // Nom de l'utilisateur
                                'prenom' => $user['firstname'],     // Nom de l'utilisateur
                                'email' => $user['email'],     // Nom de l'utilisateur
                                'telephone' => $user['telephone'], // tel de l'utilisateur
                            ];

                        $msg = ['msg' => 'Bienvenue dans l\'espace admin ', 'status' => 1];
                }else {
                    // Si l'email ou le mot de passe est incorrect
                    $msg = 'Identifiants incorrects. Veuillez vérifier votre numéro de téléphone et mot de passe.';
                }
            } else {
                $msg = ['Veuillez renseigner tous les champs!']; // Affiche les erreurs ❌
            }
            echo json_encode($msg);
        }
    }

}
