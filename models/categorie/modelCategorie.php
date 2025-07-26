<?php

class ModelCategorie
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database();
    }


    public function updatecategorie($data) // update by element
    {
        try {
            $sql = "UPDATE categories SET libelle_categorie=?, famille_id=? WHERE id_categorie=?";
            $query = $this->pdo->getCon()->prepare($sql);
            if ($query->execute($data)) {
                return true;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function addcategorie($libelle, $famille) // add a new client
    {
        try {
            $sql = ' INSERT INTO categories (libelle_categorie, famille_id) VALUES (?,?)';

            $query = $this->pdo->getCon()->prepare($sql);

            if ($query->execute([$libelle, $famille])) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            die("Erreur d'insertion" . $e->getMessage());
        }
    }

    public function getAllCategorieOrder() // obtenir toutes les données d'une table par ordre croisant
    {
        $data = '';
        try {
            $sql = " SELECT * FROM categories c, famille f WHERE f.id_famille = c.famille_id AND c.status_categorie = 1  ORDER BY c.id_categorie DESC";
            $query = $this->pdo->getCon()->prepare($sql);
            $query->execute();
            if ($query->rowCount() > 0) {
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }

        return $data;
    }

    public function getCategorieByElement($val) // obtenir une ligne de données par un element
    {
        $data = '';
        try {
            $sql = " SELECT * FROM categories c, famille f WHERE f.id_famille = c.famille_id AND c.id_categorie = ?";
            $query = $this->pdo->getCon()->prepare($sql);
            $query->execute([$val]);
            if ($query->rowCount() > 0) {
                $data = $query->fetch(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }

        return $data;
    }
}
