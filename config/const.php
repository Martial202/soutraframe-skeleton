<?php require_once 'config.php'; ?>

<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('ROOT_REMOVE_IMG', $_SERVER['DOCUMENT_ROOT']."/admin_app");
define('RACINE', 'http://localhost:8888/admin_app/');
//define('RACINE', 'https://admin.buro-store.com/');

define('RACINE_2', '/admin_app/public/');
// define('RACINE_2', '/');

// define("ANNEE", $_SESSION['user']['campagne_id'] ?? null);
define('USER_NAME', $_SESSION ? $_SESSION['admin']['nom'] : null);
define('USER_FIRSTNAME', $_SESSION ? $_SESSION['admin']['prenom'] : null);
define('USER_EMAIL', $_SESSION ? $_SESSION['admin']['email'] : null);

define('USER_PHONE', $_SESSION['admin']['telephone'] ?? null);

define('USER_ID', $_SESSION['admin']['id'] ?? null);

// define('ROLE', $_SESSION['user']['poste'] ?? null);

// define('EMAIL', $_SESSION['user']['eamil'] ?? null);

// define('TEL', $_SESSION['user']['tel'] ?? null);

// define('DOMICILE', $_SESSION['user']['domicile'] ?? null);

// define('LIB_ROLE', $_SESSION['user']['libelle_poste'] ?? null);

// define('SIGN', $_SESSION['user']['sign'] ?? null);

define('LIMIT_ENROLEMENT', 2 ?? null);


// define('ADMIN_STATUS', ($_SESSION['user']['status'] ?? null) !== STATUS_ADMIN ? '<i class="fa  fa-lock fa-lg text-danger"></i>' : '<i class="fa  fa-unlock-alt fa-lg text-success "></i>');
// define('PRO_STATUS', ($_SESSION['user']['status'] ?? null) !== STATUS_PRO_ACTIF ? '<i class="fa  fa-lock fa-lg text-danger"></i>' : '<i class="fa  fa-unlock-alt fa-lg text-success "></i>');


define('LOGO_WAVE', '<img src="' .RACINE. 'assets/logo/wave.jpg" class="img-circle" alt="Logo" height="100" width="100">');
// define('LOGO', '<img src="' .RACINE. 'assets/logo/logoblanc.jpg" alt="Logo" height="150" width="200">');
define('ICON', '<img src="'.RACINE.'assets/logo/logoblanc.jpg" alt="LOGO" style="position: relative; bottom:12px;" width="50" height="50">');
define('LOGO', '<img src="'.RACINE.'public/assets/logo/logoblanc.jpg" alt="LOGO" style="position: relative; bottom:12px;" width="50" height="50">');
define('USER_ICON', '<p class="text-center"  ><i class="fa fa-user-circle fa-lg"></i></p>');

define('IMG_ICON', RACINE.'assets/img/logo/e-logo.png');
define('TITLE_ICON', 'DienDi Tontine');

//  var_dump($_SESSION);return;
