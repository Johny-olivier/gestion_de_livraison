<?php

namespace app\models;

use app\config\Database;

class Colis extends BaseModel {
    protected static string $table = 'colis';


    /* ajouter dans la base */
    public static function create($poids_kg) {
        $db = Database::getConnection();
        $lastId = null;

        $stmt = $db->prepare("INSERT INTO colis (poids_kg) VALUES (?)");

        try {
            $stmt->execute([$poids_kg]);
            $lastId = $db->lastInsertId();
        } catch (\Throwable $th) {
            throw $th;
        }

        return $lastId;
    }

    /* colis dispo */
    public static function getDisponibles() {
        $db = Database::getConnection();
        $colis = null;

        $stmt = $db->query("
            SELECT c.*
            FROM colis c
            LEFT JOIN livraison l 
                ON c.id = l.colis_id 
                AND l.statut != 'annulé'
            WHERE l.id IS NULL
            ORDER BY c.id DESC
        ");

        try {
            $colis = $stmt->fetchAll();
        } catch (\Throwable $th) {
            throw $th;
        }

        return $colis;
    }
}
