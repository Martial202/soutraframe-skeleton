<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// session_set_cookie_params(3600); // 1 heure
session_start();

date_default_timezone_set("Africa/Abidjan");

class Database
{
    private $pdo;
    private $dns;

    private $dbname = "burostore";
    private $user = "root";
    private $password = "root";
    private $host = "localhost";

    //private $dbname = 'c2616650c_burostore';
    //private $user = 'c2616650c_burostore';
    //private $password = 'c2616650c_burostore';
    //private $host = 'localhost';


    public function __construct()
    {
        try {
            $dns = "mysql:host=$this->host;port=8889;dbname=$this->dbname"; // en local
            //$dns = "mysql:host=$this->host;dbname=$this->dbname"; // en ligne
            $this->dns = $dns;
            $this->pdo = new PDO($this->dns, $this->user, $this->password, [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
            ]);
        } catch (Exception $e) {
            die("Erreur de connexion à la base de données " . $e->getMessage());
        }
    }

    public function getCon()
    {
        return $this->pdo;
    }
}

include 'const.php';
