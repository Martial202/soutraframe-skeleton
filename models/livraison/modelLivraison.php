<?php

class ModelLivraison
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database();
    }

    public function getLivraisonByIds($id) // retourne les infos de la livraison en fonction de l'id
    {
        try {
            $sql = 'SELECT * FROM livraison l, commandes c, livreurs li WHERE l.ref_commande = c.ref_commande AND li.id_livreur = l.livreur_id AND  id_livraison = ?';

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

    public function getLivraisonOFPrintByIds($id) // retourne les infos de la livraison en fonction de l'id
    {
        try {
            $sql = 'SELECT c.*, l.code_livraison, l.date_livraison, li.full_name FROM commandes c, livraison l, livreurs li WHERE c.ref_livraison = l.ref_livraison AND li.id_livreur = l.livreur_id AND l.id_livraison = ?';

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


    public function getLivraisonByEtat($etat) // Retourne les livraisons par rapport a l'etat de la livraison
    {
        try {
            $sql = 'SELECT * FROM livraison WHERE etat_livraison = ? ORDER BY date_livraison DESC';

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

    public function getProduitOfLivraisons($id) {// les produits de la commmande
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

    



}
