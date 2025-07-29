<?php

class TestController
{
    private $validator;
    private $test;

    // constructeur pour initialiser le validator ici, pour pouvoir l'utiliser dans toutes les méthodes de la classe AccueilController
    public function __construct()
    {
        $this->validator = new Validator();
        $this->test = new ModelTest();
    }

    // public function index() // la vue de la  connexion
    // {
    //     // $nombreCommandes = $this->test->getNombreCommandesAujourdhui();
    //     // echo "Nombre de commandes aujourd'hui : " . $nombreCommandes;

    //     require_once '../views/test/index.php';
    // }
}
