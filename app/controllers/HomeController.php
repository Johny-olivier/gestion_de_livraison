<?php

namespace app\controllers;

use app\models\Entrepot;
use app\models\ZoneLivraison;
use Flight;
use app\utils\ViewUtils;

class HomeController {
    public function index() {
        $stats = [
            "livraisons_actives" => ViewUtils::getFromView('vue_livraisons_actives')[0]['total'] ?? 0,
            "chauffeurs_actifs" => ViewUtils::getFromView('vue_chauffeurs_actifs')[0]['total'] ?? 0,
            "vehicules_en_route" => ViewUtils::getFromView('vue_vehicules_en_route')[0]['total'] ?? 0,
            "taux_satisfaction" => ViewUtils::getFromView('vue_taux_satisfaction')[0]['taux'] ?? 0,
            "nb_sites" => count(Entrepot::getAll()) + count(ZoneLivraison::getAll())
        ];

        Flight::render("index", ["stats" => $stats]);
    }
}