<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../core/PrincipalRoute.php';


$route = new Router();

// Instanciation des contrôleurs
$homeController = new HomeController();
$authcontroller = new AuthController();
$familleController = new FamilleController();
$categorieController = new CategorieController();
$produitController = new ProduitController();
$commandeController = new CommandeController();
$settingController = new SettingController();
$livraisonController = new LivraisonController();
$devisController = new DevisController();
$userController = new UserController();

// ajout des routes
// LES VUES
$route->addRoute('/', [$homeController, 'index']); //vue
$route->addRoute('/home', [$homeController, 'index']); //vue
$route->addRoute('/home/deconnexion', [$homeController, 'deconnexion']); //vue
$route->addRoute('/produit/famille/{params}', [$familleController, 'index']); //vue
$route->addRoute('/produit/liste', [$produitController, 'index']); //vue
$route->addRoute('/produit/ajouter', [$produitController, 'ajouter']); //vue
$route->addRoute('/produit/modifier/{params}', [$produitController, 'modifier']); //vue
$route->addRoute('/produit/details/{params}', [$produitController, 'details']); //vue
$route->addRoute('/produit/categorie/{params}', [$categorieController, 'index']); //vue
$route->addRoute('/commande/historique', [$commandeController, 'history']); //vue
$route->addRoute('/commande/nouveau', [$commandeController, 'index']); //vue
$route->addRoute('/commande/details/{params}', [$commandeController, 'traitement']); //vue
$route->addRoute('/home/parametres', [$settingController, 'index']); // Vue de settings
$route->addRoute('/user/profil', [$userController, 'index']); // Vue de settings
$route->addRoute('/livraison/nouveau', [$livraisonController, 'index']); // Vue de settings
$route->addRoute('/livraison/history', [$livraisonController, 'history']); // Vue de settings
$route->addRoute('/livraison/details/{params}', [$livraisonController, 'traitement']); // Vue de settings
$route->addRoute('/devis/nouveau', [$devisController, 'index']); // Vue de settings
$route->addRoute('/devis/history', [$devisController, 'history']); // Vue de settings
$route->addRoute('/devis/details/{params}', [$devisController, 'details']); // Vue de settings


// LES BACKEND
$route->addRoute('/authController/connexion', [$authcontroller, 'connexion']); // backend
$route->addRoute('/familleController/add', [$familleController, 'add']); // backend
$route->addRoute('/familleController/edit', [$familleController, 'edit']); // backend
$route->addRoute('/familleControllers/change', [$familleController, 'change']); // backend
$route->addRoute('/categorieController/add', [$categorieController, 'add']); // backend
$route->addRoute('/categorieController/edit', [$categorieController, 'edit']); // backend
$route->addRoute('/categorieControllers/change', [$categorieController, 'change']); // backend
$route->addRoute('/produitController/add', [$produitController, 'add']); // backend
$route->addRoute('/produitController/edit', [$produitController, 'edit']); // backend
$route->addRoute('/produitController/change', [$produitController, 'change']); // backend
$route->addRoute('/imageController/addImage', [$produitController, 'addImage']); // backend
$route->addRoute('/livreurController/add', [$settingController, 'addLivreur']); // backend
$route->addRoute('/livreurController/edit', [$settingController, 'editLivreur']); // backend
$route->addRoute('/livreurController/change', [$settingController, 'changeLivreur']); // backend
$route->addRoute('/livraisonController/add', [$commandeController, 'addLivraison']); // backend
$route->addRoute('/livraisonController/check', [$livraisonController, 'check']); // backend
$route->addRoute('/commandeController/countNew', [$commandeController, 'countNewCommande']); // backend
$route->addRoute('/impression/bon_livraison', [$commandeController, 'generateBonLivraison']); // backend
$route->addRoute('/blogController/add', [$settingController, 'AddArticleBlog']); // backend
$route->addRoute('/blogController/edit', [$settingController, 'EditArticleBlog']); // backend
$route->addRoute('/blogController/change', [$settingController, 'changeBolg']); // backend
$route->addRoute('/devisController/countNew', [$devisController, 'countNewDevis']); // backend
$route->addRoute('/devisControllers/marqueOk', [$devisController, 'marqueOk']); // backend
$route->addRoute('/usersController/edit', [$userController, 'edit']); // backend
$route->addRoute('/usersController/editPassword', [$userController, 'editPassword']); // backend

// $route->addRoute('/home', [$homeController, 'home']); // Vue d'accueil


$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (strpos($url, '/admin_app/public') === 0) {
    $url = str_replace('/admin_app/public', '', $url);
} elseif (strpos($url, '/admin_app') === 0) {
    $url = str_replace('/admin_app', '', $url);
}
// echo 'URL traitée : ' . $url . '<br>'; // Débogage pour vérifier l'URL après retrait du préfixe

$route->run($url);
// $route->run($url);
