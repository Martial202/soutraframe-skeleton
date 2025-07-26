<?php

class HomeController
{
    private $validator;
    private $home;

    // constructeur pour initialiser le validator ici, pour pouvoir l'utiliser dans toutes les méthodes de la classe AccueilController
    public function __construct()
    {
        $this->validator = new Validator();
        $this->home = new ModelHome();
    }
    
    

    public function index() // la vue de la  connexion
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $commandeofDay = $this->home->getNombreCommandesAujourdhui();
            $commandeWaitofDay = $this->home->getNombreCommandesPar("etat_commande", 0);
            $commandeLivreofDay = $this->home->getNombreCommandesAujourdhuiPar("etat_commande", 2);
            $commandeAnnuleofDay = $this->home->getNombreCommandesAujourdhuiPar("etat_commande", 3);
            $commandeEnCourofDay = $this->home->getNombreCommandesAujourdhuiPar("etat_commande", 1);
            $commandeTotal = $this->home->getNombreCommandes("etat_commande", 0);
            $commandeLivreTotal = $this->home->getNombreCommandesPar("etat_commande", 2);
            $commandeAnnuleTotal = $this->home->getNombreCommandesPar("etat_commande", 3);
            $totalAmount = $this->home->getTotalMontantCommandesLivrees();
            $totalAmountOfDay = $this->home->getTotalMontantCommandesLivreesAujourdhui();
            // var_dump($commandeWaitofDay);
            require_once '../views/accueil/index.php'; // On inclut la vue d'accueil qui contient le code HTML
        } else {
            require_once '../views/auth/connexion.php';
        }
    }
    
    
    public function settings()
    {
        require_once '../views/parametre/settings.php';
    }

    public function deconnexion()
    {
        require_once '../views/auth/deconnexion.php';
    }
}
