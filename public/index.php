<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../core/PrincipalRoute.php';


$route = new Router();

// Instanciation des contrôleurs
// $testController = new TestController();


// ajout des routes
// LES VUES
// $route->addRoute('/', [$homeController, 'index']); //vue
// $route->addRoute('/produit/famille/{params}', [$familleController, 'index']); //vue


// LES BACKEND
// $route->addRoute('/authController/connexion', [$authcontroller, 'connexion']); // backendend

// Remplace 'admin_app' with your actual application name if different

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (strpos($url, '/admin_app/public') === 0) {
    $url = str_replace('/admin_app/public', '', $url);
} elseif (strpos($url, '/admin_app') === 0) {
    $url = str_replace('/admin_app', '', $url);
}
// echo 'URL traitée : ' . $url . '<br>'; // Débogage pour vérifier l'URL après retrait du préfixe

$route->run($url);
// $route->run($url);
