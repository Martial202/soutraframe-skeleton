<?php

class ModelAuth
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database();
    }


    
    public function addMyPassword($data) // add a new client
    {
        try {
            $sql = ' INSERT INTO passwords (user_id,site,email,password,date_created) VALUES (?,?,?,?,?)';

            $query = $this->pdo->getCon()->prepare($sql);

            if ($query->execute($data)) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            die("Erreur d'insertion".$e->getMessage());
        }
    }

    public function addMySite($data) // add a new client
    {
        try {
            $sql = ' INSERT INTO sites (user_id,site,link,description,date_created) VALUES (?,?,?,?,?)';

            $query = $this->pdo->getCon()->prepare($sql);

            if ($query->execute($data)) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            die("Erreur d'insertion".$e->getMessage());
        }
    }

    public function getUserRole($status_r) // returns le nbr de client
    {
        $result = [];
        try {
            $sql = 'SELECT * FROM users AS u INNER JOIN roles AS r ON u.role_id = r.id_role WHERE status_user != ?';

            $query = $this->pdo->getCon()->prepare($sql);

            $query->execute([$status_r]);

            if ($query->rowcount() > 0) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                return $result;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            die('Erreur de recuperation'.$e->getMessage());
        }
    }
}
