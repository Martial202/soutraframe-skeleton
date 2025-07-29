<?php

class ModelTest
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database();
    }

    // public function getNombreCommandesAujourdhui()
    // {
    //     $total = 0;
    //     try {
    //         $sql = "SELECT COUNT(*) AS total FROM commandes WHERE DATE(date_commande) = CURDATE()";
    //         $query = $this->pdo->getCon()->prepare($sql);
    //         $query->execute();
    //         if ($query->rowCount() > 0) {
    //             $result = $query->fetch(PDO::FETCH_ASSOC);
    //             $total = $result['total'];
    //         }
    //     } catch (Exception $e) {
    //         die($e->getMessage());
    //     }

    //     return $total;
    // }


}
