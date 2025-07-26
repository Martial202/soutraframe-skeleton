<?php

class LivraisonController
{
    private $validator;
    public $livraison;
    // constructeur pour initialiser le validator ici, pour pouvoir l'utiliser dans toutes les méthodes de la classe AccueilController
    public function __construct()
    {
        $this->validator = new Validator();
        $this->livraison = new ModelLivraison();
    }
    // page index de la famille
    public function index()
    {
        $allLivraisons = $this->livraison->getLivraisonByEtat(0);
        // Appel de la vue
        require_once '../views/livraison/index.php';
    }

    public function history($params = null)
    {
        $oldlivraisons = $this->livraison->getLivraisonByEtat(1);
        require_once '../views/livraison/history.php';
    }

    public function traitement($params = null)
    {
        $id = $this->validator->decrypter($params);
        $detailslivraison = $this->livraison->getlivraisonByIds($id);
        $produitsOflivraison = $this->livraison->getProduitOflivraisons($detailslivraison['id_commande']);
        // var_dump($detailslivraison);
        $status = $this->validator->getByElementItem("statut_livraison", "actions", "commande_ref", $detailslivraison['ref_commande']);
        // $codes = $this->validator->generateCode("livraison", "code_livraison", "BL-", 6);
        require_once '../views/livraison/traitement.php';
        // require_once '../views/livraison/impression_livraison.php';
    }

    public function check() // add proprio
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fPost = Validator::sanitizeInput($_POST);
            // $notEmpty = Validator::validateRequiredFields($fPost);
            extract($fPost);
            if (!empty($livraison_codes) || !empty($commande_code) || !empty($id_action)) {
                if (!$this->validator->verifs('statut_livraison', 'livraison_code', 'commande_ref', $livraison_codes,  $commande_code)) {

                    $data = [
                        "livraison_code" => $livraison_codes,
                        "commande_ref" => $commande_code,
                        "actions" => $id_action,
                        "motif" => $motif
                    ];

                    $etatcom = ($id_action == 1) ? 2 : 3 ;

                    $dataUpdateEtatLivraison =
                        [
                            "etat_livraison" => 1,
                            "code_livraison" => $livraison_codes,
                        ];

                    $dataUpdateEtatCommande =
                        [
                            "etat_commande" => $etatcom,
                            "ref_commande" => $commande_code,
                        ];
                    // var_dump("colman",$data);return;
                    if ($this->validator->insert("statut_livraison", $data)) {

                        $this->validator->update("livraison", $dataUpdateEtatLivraison);
                        $this->validator->update("commandes", $dataUpdateEtatCommande);

                        $msg = ['status' => 1, 'msg' => 'Commande livrée avec succès !'];
                    } else {
                        $msg = ['status' => 2, 'msg' => "Erreur d'insertion"];
                    }
                } else {
                    $msg = ['status' => 2, 'msg' => 'Cette commande a déjà été traitée !']; // Affiche les erreurs ❌
                }
            } else {
                $msg = ['status' => 2, 'msg' => 'Veuillez renseigner tous les champs!']; // Affiche les erreurs ❌
            }
            echo json_encode($msg);
        }
    }
}
