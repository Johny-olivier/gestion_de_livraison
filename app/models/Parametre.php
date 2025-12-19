<?php

namespace app\models;

use app\config\Database;

class Parametre extends BaseModel {
    protected static string $table = 'parametre';
    public static function get() {
        return parent::getById(1);
    }

    public static function update($gain_par_kg) {
        $db = Database::getConnection();
        $success = false;

        $stmt = $db->prepare("UPDATE parametre SET gain_par_kg = ? WHERE id = 1");

        try {
            $success = $stmt->execute([$gain_par_kg]);
        } catch (\Throwable $th) {
            throw $th;
        }

        return $success;
    }
}
