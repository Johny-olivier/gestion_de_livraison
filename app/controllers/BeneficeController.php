<?php

namespace app\controllers;

use Flight;
use app\models\Livraison;

class BeneficeController {
    public function index() {
        $request = Flight::request();

        $type  = $request->query['type']  ?? 'mois';
        $annee = $request->query['annee'] ?? date('Y');
        $mois  = $request->query['mois']  ?? date('n');
        $jour  = $request->query['jour']  ?? date('j');

        $resultats = Livraison::getBeneficeParPeriode(
            $type,
            $annee,
            $mois,
            $jour
        );

        $stats = Livraison::getStatistiques();

        $stats = [
            'ca_total'       => (float) ($stats['ca_total'] ?? 0),
            'cout_total'     => (float) ($stats['cout_total'] ?? 0),
            'benefice_total' => (float) ($stats['benefice_total'] ?? 0)
        ];

        Flight::render('benefices', [
            'type'      => $type,
            'annee'     => $annee,
            'mois'      => $mois,
            'jour'      => $jour,
            'resultats' => $resultats,
            'stats'     => $stats
        ]);
    }
}
