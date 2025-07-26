<?php

class ModelCommande
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database();
    }

    public function getCommandeByIds($id) // retourne les infos de la commande en fonction de l'id
    {
        try {
            $sql = 'SELECT * FROM commandes WHERE id_commande = ?';

            $query = $this->pdo->getCon()->prepare($sql);

            $query->execute([$id]);

            if ($query->rowcount() > 0) {
                return $query->fetch(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (\Exception $e) {
            die('Erreur de recuperation' . $e->getMessage());
        }
    }

    public function getCommandeOFPrintByIds($id) // retourne les infos de la commande en fonction de l'id
    {
        try {
            $sql = 'SELECT c.*, l.code_livraison, l.date_livraison, li.full_name FROM commandes c, livraison l, livreurs li WHERE c.ref_commande = l.ref_commande AND li.id_livreur = l.livreur_id AND l.id_livraison = ?';

            $query = $this->pdo->getCon()->prepare($sql);

            $query->execute([$id]);

            if ($query->rowcount() > 0) {
                return $query->fetch(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (\Exception $e) {
            die('Erreur de recuperation' . $e->getMessage());
        }
    }


    public function getCommandesByEtat($etat) // Retourne les commandes par rapport a l'etat de la commande
    {
        try {
            $sql = 'SELECT * FROM commandes WHERE etat_commande = ? ORDER BY date_commande DESC';

            $query = $this->pdo->getCon()->prepare($sql);

            $query->execute([$etat]);

            if ($query->rowcount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (\Exception $e) {
            die('Erreur de recuperation' . $e->getMessage());
        }
    }

    public function getCommandesByEtatH($etat1, $etat2, $etat3) // Retourne les commandes par rapport a l'etat de la commande
    {
        try {
            $sql = 'SELECT * FROM commandes WHERE etat_commande IN(?,?,?) ORDER BY date_commande DESC';

            $query = $this->pdo->getCon()->prepare($sql);

            $query->execute([$etat1, $etat2, $etat3]);

            if ($query->rowcount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (\Exception $e) {
            die('Erreur de recuperation' . $e->getMessage());
        }
    }

    public function getProduitOfCommandes($id)
    { // les produits de la commmande
        try {
            $sql = 'SELECT p.libelle_produit, p.prix_produit, l.qte_ligne, ca.libelle_categorie FROM commandes c, produits p, categories ca, ligne_commandes l WHERE ca.id_categorie = p.categorie_id AND p.id_produit = l.produit_id AND c.id_commande = l.commande_id AND c.id_commande = ?;';

            $query = $this->pdo->getCon()->prepare($sql);

            $query->execute(array($id));

            if ($query->rowcount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (\Exception $e) {
            die('Erreur de recuperation' . $e->getMessage());
        }
    }

    // public function addCommandes($data) // add a new client
    // {
    //     try {
    //         $sql = ' INSERT INTO commandes (code_commande, libelle_commande, qte_commande, prix_commande, description_commande,categorie_id) VALUES (?,?,?,?,?,?)';

    //         $query = $this->pdo->getCon()->prepare($sql);

    //         if ($query->execute($data)) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } catch (\Exception $e) {
    //         die("Erreur d'insertion" . $e->getMessage());
    //     }
    // }

    // public function updateCommande($data) // mise a jour du status rapport
    // {
    //     try {
    //         $sql = 'UPDATE commandes SET libelle_commande = ?, qte_commande =? , prx_commande = ? , description_commande =? , categorie_id =? WHERE id_commande = ?';
    //         $query = $this->pdo->getCon()->prepare($sql);
    //         if ($query->execute($data)) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } catch (\Exception $e) {
    //         die('Erreur :' . $e->getMessage());
    //     }
    // }




}
