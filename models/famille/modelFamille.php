<?php

class ModelFamille
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database();
    }


    public function updatefamille($data) // update by element
    {
        try {
            $sql = "UPDATE famille SET libelle_famille=? WHERE id_famille=?";
            $query = $this->pdo->getCon()->prepare($sql);
            if ($query->execute($data)) {
                return true;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function addfamille($libelle) // add a new client
    {
        try {
            $sql = ' INSERT INTO famille (libelle_famille) VALUES (?)';

            $query = $this->pdo->getCon()->prepare($sql);

            if ($query->execute([$libelle])) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            die("Erreur d'insertion" . $e->getMessage());
        }
    }
}
