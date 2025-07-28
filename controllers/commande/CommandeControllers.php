<?php

class CommandeController
{
    private $validator;
    public $commande;
    // constructeur pour initialiser le validator ici, pour pouvoir l'utiliser dans toutes les méthodes de la classe AccueilController
    public function __construct()
    {
        $this->validator = new Validator();
        $this->commande = new ModelCommande();
    }
    // page index de la famille
    public function index()
    {
        $allCommandes = $this->commande->getCommandesByEtat(0);
        // Appel de la vue
        require_once '../views/commande/index.php';
    }

    public function history($params = null)
    {
        $oldCommandes = $this->commande->getCommandesByEtatH(1, 2, 3);
        // var_dump($oldCommandes);
        require_once '../views/commande/history.php';
    }

    public function traitement($params = null)
    {
        $id = $this->validator->decrypter($params);
        $detailsCommande = $this->commande->getCommandeByIds($id);
        $produitsOfCommande = $this->commande->getProduitOfCommandes($id);
        $livreurs = $this->validator->getAllByElementOrder("livreurs", "etat_livreur", 1, "id_livreur");
        $codes = $this->validator->generateCode("livraison", "code_livraison", "BL-", 6);
        require_once '../views/commande/traitement.php';
        // require_once '../views/commande/impression_livraison.php';
    }

    public function addLivraison()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fPost = Validator::sanitizeInput($_POST);
            $notEmpty = Validator::validateRequiredFields($fPost);
            extract($fPost);

            if ($notEmpty === true) {
                if (!$this->validator->verif('livraison', 'ref_commande', $code_commande)) {
                    $data = [
                        "code_livraison" => $code_livraison,
                        "ref_commande" => $code_commande,
                        "date_livraison" => date('Y-m-d H:i:s'),
                        "livreur_id" => $id_livreur
                    ];

                    $dataUpdateEtatCommande =
                        [
                            "etat_commande" => 1,
                            "ref_commande" => $code_commande,
                        ];

                    // ➤ Insertion et récupération de l'ID
                    $id_livraison = $this->validator->insertWithLastId("livraison", $data, true); // true = retourner l'ID
                    if ($id_livraison) {
                        $msg = [
                            'status' => 1,
                            'msg' => 'Enregistrement effectué avec succès !',
                            'id_livraison' => $id_livraison // important pour l’appel PDF ensuite
                        ];
                        $this->validator->update("commandes", $dataUpdateEtatCommande);
                    } else {
                        $msg = ['status' => 2, 'msg' => "Erreur d'insertion"];
                    }
                } else {
                    $msg = ['status' => 2, 'msg' => 'Cette livraison existe déjà !'];
                }
            } else {
                $msg = ['status' => 2, 'msg' => 'Veuillez renseigner tous les champs !'];
            }

            echo json_encode($msg);
        }
    }

    public function generateBonLivraison()
    {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            exit("ID livraison manquant");
        }

        $id_livraison = intval($_GET['id']);
        $dataCommande = $this->commande->getCommandeOFPrintByIds("l.id_livraison", $id_livraison);
        $produits = $this->commande->getProduitOfCommandes($dataCommande['id_commande']);
        // Tu peux ici faire une requête en base pour récupérer commande + produits
        // Exemple statique pour test :
        $commande = [
            'code_commande' => $dataCommande['ref_commande'],
            'code_livraison' => $dataCommande['code_livraison'],
            'date_commande' => $dataCommande['date_commande'],
            'date_livraison' => $dataCommande['date_livraison'],
            'livreur' => $dataCommande['full_name'],
            'client' => $dataCommande['full_name_client'],
            'contact' => $dataCommande['telephone_client'],
            'lieu_livraison' => $dataCommande['lieu_livraison']
        ];

        // $commande = [
        //     'code_livraison' => $dataCommande['code_livraison'],
        //     'client' => $dataCommande['full_name_client'],
        //     'adresse' => $dataCommande['lieu_livraison'],
        //     'contact' => $dataCommande['telephone_client'],
        //     'date_livraison' => $dataCommande['date_livraison']
        // ];

        require_once '../views/commande/impression_livraison.php';


        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->InfoCommande($commande);
        $pdf->TableauProduits($produits);

        // Deuxième page = souche
        $pdf->addSoucheCopy($commande, $produits);

        // Retourne le PDF pour AJAX (output blob)
        ob_clean();
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="bon_livraison.pdf"');
        echo $pdf->Output('S');
        exit;
    }

    public function imprimer($param)
    {
        if (!isset($param) || empty($param)) {
            http_response_code(400);
            exit("ID livraison manquant");
        }
        // Décrypte le paramètre pour obtenir l'ID de la livraison
        // Assurez-vous que le paramètre est correctement formaté
        $id = $this->validator->decrypter($param);
        if (!$id) {
            http_response_code(400);
            exit("ID livraison invalide");
        }
        // Récupère les données de la commande et des produits associés
        // Assurez-vous que la méthode getCommandeOFPrintByIds est correctement définie dans ModelCommande
        if (!is_numeric($id)) {
            http_response_code(400);
            exit("ID livraison invalide");
        }
        // Récupère les données de la commande et des produits associés
        $id = intval($id); // Assurez-vous que l'ID est un entier
        if ($id <= 0) {
            http_response_code(400);
            exit("ID livraison invalide");
        }
        // Récupère les données de la commande et des produits associés
        $dataCommande = $this->commande->getCommandeOFPrintByIds("c.id_commande", $id);
        if (!$dataCommande) {
            http_response_code(404);
            exit("Commande non trouvée");
        }
        $produits = $this->commande->getProduitOfCommandes($dataCommande['id_commande']);
        if (!$produits) {
            http_response_code(404);
            exit("Aucun produit trouvé pour cette commande");
        }
        // Tu peux ici faire une requête en base pour récupérer commande + produits
        // Exemple statique pour test :
        $commande = [
            'code_commande' => $dataCommande['ref_commande'],
            'code_livraison' => $dataCommande['code_livraison'],
            'date_commande' => $dataCommande['date_commande'],
            'date_livraison' => $dataCommande['date_livraison'],
            'livreur' => $dataCommande['full_name'],
            'client' => $dataCommande['full_name_client'],
            'contact' => $dataCommande['telephone_client'],
            'lieu_livraison' => $dataCommande['lieu_livraison']
        ];

        // $commande = [
        //     'code_livraison' => $dataCommande['code_livraison'],
        //     'client' => $dataCommande['full_name_client'],
        //     'adresse' => $dataCommande['lieu_livraison'],
        //     'contact' => $dataCommande['telephone_client'],
        //     'date_livraison' => $dataCommande['date_livraison']
        // ];

        require_once '../views/commande/impression_livraison.php';


        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->InfoCommande($commande);
        $pdf->TableauProduits($produits);

        // Deuxième page = souche
        $pdf->addSoucheCopy($commande, $produits);

        // Retourne le PDF pour AJAX (output blob)
        ob_clean();
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="bon_livraison.pdf"');
        echo $pdf->Output('S');
        exit;
    }

    public function countNewCommande()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // On suppose que "nouvelle commande" = etat_commande = 0
            $count = $this->validator->countCommandesByEtat("commandes", "etat_commande", 0); // À créer dans ModelCommande si besoin
            if ($count !== false && $count > 0) {
                $msg = ['status' => 1, 'count' => $count];
            } else {
                $msg = ['status' => 2, 'count' => 0, 'msg' => "Erreur lors du comptage"];
            }
            echo json_encode($msg);
        }
    }
}
