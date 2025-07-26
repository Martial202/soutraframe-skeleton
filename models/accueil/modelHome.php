<?php

class ModelHome
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database();
    }

    public function getNombreCommandesAujourdhui()
    {
        $total = 0;
        try {
            $sql = "SELECT COUNT(*) AS total FROM commandes WHERE DATE(date_commande) = CURDATE()";
            $query = $this->pdo->getCon()->prepare($sql);
            $query->execute();
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $total = $result['total'];
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }

        return $total;
    }

    public function getNombreCommandesAujourdhuiPar($champ, $valeur)
    {
        $total = 0;
        try {
            $sql = "SELECT COUNT(*) AS total FROM commandes WHERE DATE(date_commande) = CURDATE() AND $champ = ?";
            $query = $this->pdo->getCon()->prepare($sql);
            $query->execute([$valeur]);
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $total = $result['total'];
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }

        return $total;
    }

    public function getNombreCommandesPar($champ, $valeur)
    {
        $total = 0;
        try {
            $sql = "SELECT COUNT(*) AS total FROM commandes WHERE $champ = ?";
            $query = $this->pdo->getCon()->prepare($sql);
            $query->execute([$valeur]);
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $total = $result['total'];
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }

        return $total;
    }

    public function getNombreCommandes()
    {
        $total = 0;
        try {
            $sql = "SELECT COUNT(*) AS total FROM commandes";
            $query = $this->pdo->getCon()->prepare($sql);
            $query->execute();
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $total = $result['total'];
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }

        return $total;
    }


    public function getTotalMontantCommandesLivrees()
    {
        $total = 0;
        try {
            $sql = "SELECT SUM(montant_commande) AS total FROM commandes WHERE etat_commande = 2";
            $query = $this->pdo->getCon()->prepare($sql);
            $query->execute();
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $total = $result['total'] ?? 0;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }

        return $total;
    }

    public function getTotalMontantCommandesLivreesAujourdhui()
    {
        $total = 0;
        try {
            $sql = "SELECT SUM(montant_commande) AS total 
                FROM commandes 
                WHERE etat_commande = 2 
                  AND DATE(date_commande) = CURDATE()";

            $query = $this->pdo->getCon()->prepare($sql);
            $query->execute();

            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $total = $result['total'] ?? 0;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }

        return $total;
    }
}
