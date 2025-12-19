<?php
$ds = DIRECTORY_SEPARATOR;

require_once __DIR__ . $ds . "constant.php";
/**********************************************
 *         Environnement Application          *
 **********************************************/
// Fuseau horaire (Madagascar)
date_default_timezone_set('Indian/Antananarivo');

// Rapport d'erreurs (E_ALL pour développement)
error_reporting(E_ALL);

// Encodage des caractères
if (function_exists('mb_internal_encoding')) {
    mb_internal_encoding('UTF-8');
}

// Locale par défaut
if (function_exists('setlocale')) {
    setlocale(LC_ALL, 'fr_FR.UTF-8');
}

/**********************************************
 *         Paramètres FlightPHP               *
 **********************************************/
// Récupération de l'instance Flight
if (empty($app)) {
    $app = Flight::app();
}

// Autoloader pour le dossier app/
$app->path(__DIR__ . $ds . '..' . $ds . '..');

// Configuration Flight

$app->set('flight.base_url', BASE_URL);
$app->set('flight.case_sensitive', false);
$app->set('flight.log_errors', true);
$app->set('flight.handle_errors', false);
$app->set('flight.views.path', __DIR__ . $ds . '..' . $ds . 'views');
$app->set('flight.views.extension', '.php');
$app->set('flight.content_length', false);

// Génération d'un nonce CSP pour la sécurité
$nonce = bin2hex(random_bytes(16));
$app->set('csp_nonce', $nonce);

/**********************************************
 *         Configuration Utilisateur          *
 **********************************************/
return [
    // MySQL
    'database' => [
        'host'     => 'localhost',      
        'user'     => 'ETU004282',         
        'password' => 'OgeGnKyQ',         
        'dbname'   => 'db_s2_ETU004282', 
        'charset'  => 'utf8mb4',       
    ]
];