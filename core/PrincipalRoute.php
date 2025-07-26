<?php

// chemin publics //

require_once '../config/Database.php';

require_once '../models/Validator.php';

require_once '../core/Router.php';

require_once('../libs/fpdf/fpdf.php');
require_once('../libs/fpdf/font/Orbitron-Bold.php');
require_once('../views/commande/impression_livraison.php');
// chemin des models

require_once '../models/accueil/modelHome.php';
require_once '../models/famille/modelFamille.php';
require_once '../models/categorie/modelCategorie.php';
require_once '../models/produit/modelProduit.php';
require_once '../models/commande/modelCommande.php';
require_once '../models/livraison/modelLivraison.php';
require_once '../models/devis/modelDevis.php';

// chemin des controllers

require_once '../controllers/auth/AuthControllers.php';
require_once '../controllers/accueil/HomeControllers.php';
require_once '../controllers/famille/FamilleControllers.php';
require_once '../controllers/categorie/CategorieControllers.php';
require_once '../controllers/produits/ProduitControllers.php';
require_once '../controllers/commande/CommandeControllers.php';
require_once '../controllers/parametre/settingControllers.php';
require_once '../controllers/livraison/livraisonControllers.php';
require_once '../controllers/devis/devisControllers.php';
require_once '../controllers/users/userControllers.php';


