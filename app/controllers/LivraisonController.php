<?php

namespace app\controllers;

use app\models\Chauffeur;
use app\models\Colis;
use app\models\Entrepot;
use app\models\Livraison;
use app\models\Vehicule;
use app\models\ZoneLivraison;
use app\utils\ViewUtils;
use Flight;

class LivraisonController {

    // GET /livraisons/
    public function index() {
        $livraisons = Livraison::getAll();

        Flight::render(
            "livraisons/index",
            [
                "title" => "Listes des livraisons",
                "livraisons" => $livraisons
            ]
        );
    }

    // GET /livraisons/create
    public function create() {
        $colis = Colis::query("
            SELECT * FROM colis 
            WHERE id NOT IN (
                SELECT colis_id 
                FROM livraison 
                WHERE statut IN ('en attente', 'livré')
            )
        ");

        $selectData = $this->getAllSelectData();
        $sidebarData = $this->getSidebarData();

        // Conserver exactement les clés originales pour les vues
        $data = [
            "colis" => $colis,
            "chauffeurs" => $selectData["chauffeurs"],
            "vehicules" => $selectData["vehicules"],
            "zone_livraisons" => $selectData["zones"],
            "entrepots" => $selectData["entrepots"],
            "livraisons" => $sidebarData["livraisons"],
            "chauffeurs_actifs" => $sidebarData["chauffeurs_actifs"],
            "vehicules_disponibles" => $sidebarData["vehicules_disponibles"]
        ];

        Flight::render(
            "livraisons/create",
            [
                "title" => "Ajouter une livraison - Gestion de Livraison",
                "data" => $data
            ]
        );
    }

    // POST /livraisons/create
    public function store() {
        $request = Flight::request();

        $livraisonData = [
            'colis_id'      => $request->data->colis_id,
            'chauffeur_id'  => $request->data->chauffeur_id,
            'vehicule_id'   => $request->data->vehicule_id,
            'zone_id'       => $request->data->zone_id,
            'entrepot_id'   => $request->data->entrepot_id,
            'date_livraison'=> $request->data->date_livraison,
            'statut'        => $request->data->statut
        ];

        $success = Livraison::create($livraisonData);
        Flight::redirect(BASE_URL . "livraisons?success=$success");
    }

    // GET /update/@id
    public function edit($id) {
        $livraison = $this->getLivraisonOrRedirect($id);
        $selectData = $this->getAllSelectData();
        $sidebarData = $this->getSidebarData();

        // Clés exactes pour la vue update.php
        $data = [
            "livraison" => $livraison,
            "colis" => $selectData["colis"],
            "chauffeurs" => $selectData["chauffeurs"],
            "vehicules" => $selectData["vehicules"],
            "zones" => $selectData["zones"],
            "entrepots" => $selectData["entrepots"],
            "livraisons" => $sidebarData["livraisons"],
            "chauffeurs_actifs" => $sidebarData["chauffeurs_actifs"],
            "vehicules_disponibles" => $sidebarData["vehicules_disponibles"]
        ];

        Flight::render(
            "livraisons/update",
            array_merge(["title" => "Modifier Livraison #$id - Gestion de Livraison"], $data)
        );
    }

    // POST /update/@id
    public function update($id) {
        $request = Flight::request();
        $livraison = $this->getLivraisonOrRedirect($id);

        $data = [
            'colis_id'       => $request->data->colis_id,
            'chauffeur_id'   => $request->data->chauffeur_id,
            'vehicule_id'    => $request->data->vehicule_id,
            'zone_id'        => $request->data->zone_id,
            'entrepot_id'    => $request->data->entrepot_id,
            'date_livraison' => $request->data->date_livraison,
            'statut'         => $request->data->statut,
        ];

        $success = Livraison::updateById($id, $data);
        Flight::redirect(BASE_URL . "livraisons?success=$success");
    }

    // GET /show/@id
    public function show($id) {
        $livraison = $this->getLivraisonOrRedirect($id);

        $chauffeur = Chauffeur::getById($livraison['chauffeur_id']);
        $vehicule = Vehicule::getById($livraison['vehicule_id']);
        $zone = ZoneLivraison::getById($livraison['zone_id']);
        $entrepot = Entrepot::getById($livraison['entrepot_id']);

        $sidebarData = $this->getSidebarData();

        // Clés exactes pour show.php
        $livraisonData = [
            "id" => $livraison["id"],
            "colis_id" => $livraison["colis_id"],
            "chauffeur_id" => $chauffeur["id"] ?? null,
            "chauffeur_nom" => $chauffeur["nom"] ?? "-",
            "vehicule_id" => $vehicule["id"] ?? null,
            "vehicule_immatriculation" => $vehicule["immatriculation"] ?? "-",
            "zone_id" => $zone["id"] ?? null,
            "zone_nom" => $zone["nom"] ?? "-",
            "entrepot_id" => $entrepot["id"] ?? null,
            "entrepot_nom" => $entrepot["nom"] ?? "-",
            "entrepot_adresse" => $entrepot["adresse"] ?? "-",
            "date_livraison" => $livraison["date_livraison"],
            "statut" => $livraison["statut"],
        ];

        Flight::render(
            "livraisons/show",
            [
                "title" => "Détails Livraison #$id",
                "livraison" => $livraisonData,
                "livraisons" => $sidebarData["livraisons"],
                "chauffeurs_actifs" => $sidebarData["chauffeurs_actifs"],
                "vehicules_disponibles" => $sidebarData["vehicules_disponibles"]
            ]
        );
    }

    // POST /delete/@id
    public function delete($id) {
        // Vérifier que la livraison existe
        $livraison = $this->getLivraisonOrRedirect($id);

        // Supprimer la livraison
        $success = Livraison::deleteById($id);

        // Redirection avec retour succès ou erreur
        if ($success) {
            Flight::redirect(BASE_URL . "livraisons?success=1");
        } else {
            Flight::redirect(BASE_URL . "livraisons?error=delete_failed");
        }
    }


    // ---------------------
    // Méthodes privées pour factoriser
    // ---------------------
    private function getSidebarData() {
        $livraisons = Livraison::getAll();
        $chauffeurs_actifs = ViewUtils::getFromView("vue_chauffeurs_actifs")[0]["total"] ?? 0;
        $vehicules_disponibles = Vehicule::query("
            SELECT COUNT(DISTINCT vehicule_id) AS total
            FROM livraison
            WHERE statut != 'en attente'
        ")[0]["total"] ?? 0;

        return [
            "livraisons" => $livraisons,
            "chauffeurs_actifs" => $chauffeurs_actifs,
            "vehicules_disponibles" => $vehicules_disponibles
        ];
    }

    private function getAllSelectData() {
        return [
            "colis" => Colis::getAll(),
            "chauffeurs" => Chauffeur::getAll(),
            "vehicules" => Vehicule::getAll(),
            "zones" => ZoneLivraison::getAll(),
            "entrepots" => Entrepot::getAll()
        ];
    }

    private function getLivraisonOrRedirect($id) {
        $livraison = Livraison::getById($id);
        if (!$livraison) {
            Flight::redirect(BASE_URL . "livraisons?error=not_found");
            exit;
        }
        return $livraison;
    }
}
