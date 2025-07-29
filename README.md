# ⚙️ SoutraFrame (PHP MVC)

**SoutraFrame** est un mini-framework PHP développé pour offrir une base modulaire, extensible et maintenable. Conçu en architecture MVC, il est destiné aux applications de gestion (administration, e-commerce, facturation, etc.), et peut être utilisé comme point de départ pour tout nouveau projet PHP personnalisé.

> Le projet vise à faciliter la gestion des utilisateurs, des commandes, des fichiers et du contenu, avec une interface d’administration responsive et un système de routage personnalisé.

---

## 📁 Structure complète du projet

```
gbekeinfos/
├── config/                 # Paramètres globaux et base de données
├── controllers/            # (à créer) Contrôleurs pour chaque module
├── core/                   # Cœur du framework (Router, routes, erreurs)
│   └── errors/             # Pages d’erreur personnalisées (404, 500)
├── models/                 # Modèles de données + tests
├── public/                 # Fichiers publics (index.php, assets, includes)
│   ├── includes/           # En-têtes, sécurité, pied de page
│   ├── FonctionAjax/       # Fichiers JS pour appels AJAX (tinyMCE, etc.)
│   ├── assets/             # (peut contenir images, CSS, JS globaux)
│   └── .htaccess           # Redirection propre vers index.php
├── views/                  # (à créer) Contiendra les vues HTML/PHP
├── .htaccess               # Redirection propre vers index.php (racine)
└── README.md               # Fichier de documentation
```

---

## 🧐 Philosophie du Framework

* **Séparation stricte des responsabilités** (MVC)
* **Routing simple et modulaire** via `core/Router.php`
* **Personnalisation facile** pour différents types de projets

---

## 🔌 Installation rapide

### 1. Cloner le dépôt

```bash
git clone https://github.com/votre-utilisateur/gbekeinfos.git
```

### 2. Configurer la base de données

Modifier les informations dans `config/Database.php` :

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'nom_de_votre_base');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### 3. Démarrer en local

* Copier le dossier dans `htdocs/` de **MAMP** ou **XAMPP**
* Lancer Apache + MySQL
* Visiter : [http://localhost:8888/gbekeinfos/public/](http://localhost:8888/gbekeinfos/public/)

---

## 🧱 Détail des dossiers et fichiers

### `config/`

* `Database.php` : Connexion PDO à MySQL.
* `const.php` : Constantes globales du projet.
* `config.php` : Paramètres généraux.

### `core/`

* `Router.php` : Gestion des routes HTTP.
* `PrincipalRoute.php` : Centralisation ou regroupement de routes.
* `errors/404.php`, `500.php` : Pages d’erreur personnalisées.

### `models/`

* `Validator.php` : Validation de champs (ex : formulaire).
* `test/modeltest.php` : Exemple de test ou script de débogage.

### `public/index.php`

* Point d’entrée de l’application.

### `public/includes/`

* `securite.php` : Sécurité et session utilisateur.
* `header.php`, `footer.php` : HTML générique.
* `links/` : CSS/JS externes.

### `public/FonctionAjax/`

* `ajax.js`, `func.js` : Fonctions JS.
* `tinymce.min.js` : Éditeur WYSIWYG intégré.

### `public/.htaccess`

* Fichier `.htaccess` du dossier public pour la réécriture d’URL propre.

---

## 🚦 Définition d’une route

```php
// core/Router.php
$router->get('/utilisateurs', 'UserController@index');
$router->post('/commandes', 'CommandeController@store');
```

---

## ✍️ Création d’un contrôleur

### `controllers/UserController.php`

```php
class UserController {
    public function index() {
        $users = User::all();
        require_once('../views/users/index.php');
    }
}
```

---

## 📄 Exemple de modèle

### `models/User.php`

```php
class User {
    public static function all() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }
}
```

---

## 🤮 Tests de modèles

Ajouter dans `models/test/modeltest.php` :

```php
require_once '../User.php';
$users = User::all();
print_r($users);
```

---

## 🔮 Évolutions possibles

* Authentification par jeton
* API REST complète
* Génération PDF (factures, rapports)
* Upload sécurisé de fichiers
* Panneau d’administration complet

---

## 🧑‍💻 Auteur

Projet conçu et développé par **SmartCodes Team**.

---

## 📜 Licence

Ce projet est distribué sous **licence privée**.
Aucune reproduction sans autorisation.

---

## 📌 Rappels pour tes futurs projets

* Commence toujours par dupliquer ce framework.
* Renomme le dossier et configure `Database.php`.
* Adapte `Router.php` selon les nouveaux modules.
* Organise les vues par dossier (ex: `views/produits/`, `views/commandes/`).

---
