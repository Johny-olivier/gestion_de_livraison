<?php

use app\controllers\BeneficeController;
use app\controllers\HomeController;
use app\controllers\LivraisonController;

use app\middlewares\SecurityHeadersMiddleware;
use Flight;
use flight\Engine;
use flight\net\Router;

/**
 * @var Router $router
 * @var Engine $app
 */
$app = Flight::app();

// Toutes les routes protégées par le middleware
$router->group('', function (Router $router) use ($app) {
    // home
    $router->get("/", [HomeController::class, "index"]);
    
    // about
    $router->get("/about", function() use ($app) {
        $app->render("about", null);
    });
    
    // livraisons 
    $router->group("/livraisons", function(Router $router) {
        // Liste des livraisons
        $router->get("/", [LivraisonController::class, "index"]);
        // Formulaire d'ajout
        $router->get("/create", [LivraisonController::class, "create"]);
        // Traitement create
        $router->post("/create", [LivraisonController::class, "store"]);
        // Formulaire edit
        $router->get("/update/@id", [LivraisonController::class, "edit"]);
        // Traitement update
        $router->post("/update/@id", [LivraisonController::class, "update"]);
        // Affichage d'une livraison
        $router->get("/show/@id", [LivraisonController::class, "show"]);
        // delete
        $router->post("/delete/@id", [LivraisonController::class, "delete"]);
    });


    // benefices
    $router->get("/benefices", [BeneficeController::class, "index"]);

}, [SecurityHeadersMiddleware::class]);

// Gestion des erreurs 404
Flight::map('notFound', function() use ($app) {
    $app->response()->status(404);
    $app->render('errors/404');
});

// Gestion des erreurs 500
Flight::map('error', function(Throwable $error) use ($app) {
    $app->response()->status(500);
    $app->render('errors/500', ['error' => $error]);
});