<?php

namespace app\models;

use app\config\Database;

class Livraison extends BaseModel {
    protected static string $table = 'livraison';

    public static function create($data) {
        $db = Database::getConnection();
        $success = false;

        $stmt = $db->prepare("
            INSERT INTO livraison 
            (colis_id, chauffeur_id, vehicule_id, zone_id, entrepot_id, statut, date_livraison)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        try {
            $success = $stmt->execute([
                $data['colis_id'],
                $data['chauffeur_id'],
                $data['vehicule_id'],
                $data['zone_id'],
                $data['entrepot_id'],
                $data['statut'],
                $data['date_livraison']
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }

        return $success;
    }

    public static function updateById($id, $data) {
        $db = Database::getConnection();
        $success = false;

        $sql = "UPDATE livraison SET 
                    colis_id = ?, 
                    chauffeur_id = ?, 
                    vehicule_id = ?, 
                    zone_id = ?, 
                    entrepot_id = ?, 
                    date_livraison = ?, 
                    statut = ?
                WHERE id = ?";

        $params = [
            $data['colis_id'],
            $data['chauffeur_id'],
            $data['vehicule_id'],
            $data['zone_id'],
            $data['entrepot_id'],
            $data['date_livraison'],
            $data['statut'],
            $id
        ];

        $stmt = $db->prepare($sql);

        try {
            $success = $stmt->execute($params);
        } catch (\Throwable $th) {
            throw $th;
        }

        return $success;
    }


    public static function updateStatut($id, $statut) {
        $db = Database::getConnection();
        $success = false;

        $stmt = $db->prepare("UPDATE livraison SET statut = ? WHERE id = ?");

        try {
            $success = $stmt->execute([$statut, $id]);
        } catch (\Throwable $th) {
            throw $th;
        }

        return $success;
    }

    public static function getBeneficeParPeriode($type = 'mois', $annee = null, $mois = null, $jour = null) {
        $db = Database::getConnection();
        $resultats = [];

        try {
            if ($type === 'jour' && $annee && $mois && $jour) {
                $stmt = $db->prepare("
                    SELECT 
                        DATE(l.date_livraison) AS periode,
                        SUM((c.poids_kg * p.gain_par_kg) 
                            - (ch.salaire_par_livraison + v.cout_par_livraison)
                        ) AS benefice_total
                    FROM livraison l
                    JOIN colis c ON l.colis_id = c.id
                    JOIN chauffeur ch ON l.chauffeur_id = ch.id
                    JOIN vehicule v ON l.vehicule_id = v.id
                    JOIN parametre p ON p.id = 1
                    WHERE l.statut = 'livré'
                        AND YEAR(l.date_livraison) = ?
                        AND MONTH(l.date_livraison) = ?
                        AND DAY(l.date_livraison) = ?
                    GROUP BY DATE(l.date_livraison)
                ");
                $stmt->execute([$annee, $mois, $jour]);
            } elseif ($type === 'mois') {
                $stmt = $db->query("
                    SELECT 
                        CONCAT(annee, '-', LPAD(mois, 2, '0')) AS periode,
                        benefice_total
                    FROM vue_benefice_par_mois
                    ORDER BY annee DESC, mois DESC
                ");
            } else {
                $stmt = $db->query("
                    SELECT 
                        YEAR(l.date_livraison) AS periode,
                        SUM((c.poids_kg * p.gain_par_kg)
                            - (ch.salaire_par_livraison + v.cout_par_livraison)
                        ) AS benefice_total
                    FROM livraison l
                    JOIN colis c ON l.colis_id = c.id
                    JOIN chauffeur ch ON l.chauffeur_id = ch.id
                    JOIN vehicule v ON l.vehicule_id = v.id
                    JOIN parametre p ON p.id = 1
                    WHERE l.statut = 'livré'
                    GROUP BY YEAR(l.date_livraison)
                    ORDER BY YEAR(l.date_livraison) DESC
                ");
            }

            $resultats = $stmt->fetchAll();
        } catch (\Throwable $th) {
            throw $th;
        }

        return $resultats;
    }

    public static function getStatistiques() {
        $db = Database::getConnection();
        $stats = [];

        try {
            $stmt = $db->query("SELECT COUNT(*) AS total FROM livraison");
            $stats['total_livraisons'] = $stmt->fetch()['total'];

            $stmt = $db->query("SELECT statut, COUNT(*) AS count FROM livraison GROUP BY statut");
            $stats['par_statut'] = $stmt->fetchAll();

            $stmt = $db->query("SELECT SUM(chiffre_affaire) AS total FROM vue_chiffre_affaire");
            $stats['ca_total'] = $stmt->fetch()['total'] ?? 0;

            $stmt = $db->query("SELECT SUM(cout_de_revient) AS total FROM vue_cout_revient");
            $stats['cout_total'] = $stmt->fetch()['total'] ?? 0;

            $stmt = $db->query("SELECT SUM(benefice) AS total FROM vue_benefice_livraison");
            $stats['benefice_total'] = $stmt->fetch()['total'] ?? 0;

        } catch (\Throwable $th) {
            throw $th;
        }

        return $stats;
    }
}
