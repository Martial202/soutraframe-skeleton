<?php

class ModelProduit
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database();
    }

    public function getProduitByIds($id) // returns des apparts d'un proprio
    {
        try {
            $sql = 'SELECT * FROM produits AS p 
            INNER JOIN categories c 
            ON p.categorie_id = c.id_categorie 
            INNER JOIN famille f
            ON c.famille_id = f.id_famille 
            WHERE p.id_produit = ?';

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


    public function getProduits() // returns des apparts d'un proprio
    {
        try {
            $sql = 'SELECT * FROM produits AS p INNER JOIN categories c ON p.categorie_id = c.id_categorie WHERE p.status_produit = 1';

            $query = $this->pdo->getCon()->prepare($sql);

            $query->execute();

            if ($query->rowcount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (\Exception $e) {
            die('Erreur de recuperation' . $e->getMessage());
        }
    }

    public function addProduits($data) // add a new client
    {
        try {
            $sql = ' INSERT INTO produits (code_produit, libelle_produit, qte_produit, prix_produit, description_produit,categorie_id) VALUES (?,?,?,?,?,?)';

            $query = $this->pdo->getCon()->prepare($sql);

            if ($query->execute($data)) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            die("Erreur d'insertion" . $e->getMessage());
        }
    }

    public function updateProduit($data) // mise a jour du status rapport
    {
        try {
            $sql = 'UPDATE produits SET libelle_produit = ?, qte_produit =? , prix_produit = ? , description_produit =? , categorie_id =? WHERE id_produit = ?';
            $query = $this->pdo->getCon()->prepare($sql);
            if ($query->execute($data)) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            die('Erreur :' . $e->getMessage());
        }
    }




}
