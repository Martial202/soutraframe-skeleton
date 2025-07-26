<?php

class DevisController
{
    private $validator;
    public $devis;
    // constructeur pour initialiser le validator ici, pour pouvoir l'utiliser dans toutes les méthodes de la classe AccueilController
    public function __construct()
    {
        $this->validator = new Validator();
        $this->devis = new ModelDevis();
    }
    // page index de la famille
    public function index()
    {
        $allDevis = $this->devis->getDevisByEtats(0);
        // var_dump($allDevis);
        // Appel de la vue
        require_once '../views/devis/index.php';
    }
    public function history($params = null)
    {
        $oldDevis = $this->devis->getDevisByEtats(1);
        // var_dump($oldDevis);
        require_once '../views/devis/history.php';
    }


    public function countNewDevis()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // On suppose que "nouvelle commande" = etat_commande = 0
            $count = $this->validator->countCommandesByEtat("devis", "etat_devis", 0); // À créer dans ModelCommande si besoin
            if ($count !== false && $count > 0) {
                $msg = ['status' => 1, 'count' => $count];
            } else {
                $msg = ['status' => 2, 'count' => 0, 'msg' => "Erreur lors du comptage"];
            }
            echo json_encode($msg);
        }
    }

    // public function history($params = null)
    // {
    //     $oldCommandes = $this->commande->getCommandesByEtatH(1, 2, 3);
    //     // var_dump($oldCommandes);
    //     require_once '../views/commande/history.php';
    // }

    public function details($params = null)
    {
        $id = $this->validator->decrypter($params);
        $detailsDevis = $this->devis->getDevisByIds($id);
        // var_dump($detailsDevis);
        require_once '../views/devis/details.php';
    }

    public function marqueOk() // supprimer produit
    {
        $msg = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            extract($_POST);
            if ($btn_changer == 1) {
                if ($this->validator->verif('devis', 'id_devis', $id)) {
                    if ($this->validator->updateByElement('devis', 'etat_devis', 1, 'id_devis', $id)) {
                        $msg = ['status' => 1, 'msg' => 'Devis marqué comme traité avec succès'];
                    } else {
                        $msg = ['status' => 2, 'msg' => 'Erreur lors de la mise à jour du devis'];
                    }
                } else {
                    $msg = ['status' => 2, 'msg' => 'Devis introuvable'];
                }
            } else {
                $msg = ["msg" => 'Une erreur est survenue! ']; // Affiche les erreurs ❌
            }
            echo json_encode($msg);
        }
    }

}
