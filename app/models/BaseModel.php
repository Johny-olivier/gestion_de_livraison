<?php

namespace app\models;

use app\config\Database;

abstract class BaseModel {

    protected static string $table;

    public function __construct() {}

    protected static function getTable(): string {
        if (empty(static::$table)) {
            throw new \Exception("Table non définie dans le modèle : " . static::class);
        }
        return static::$table;
    }

    public static function getAll() {
        $db = Database::getConnection();
        $all = null;

        $table = static::getTable();
        $stmt = $db->prepare("SELECT * FROM {$table}");

        try {
            $stmt->execute();
            $all = $stmt->fetchAll();
        } catch (\Throwable $th) {
            throw $th;
        }

        return $all;
    }

    public static function getById($id) {
        $db = Database::getConnection();
        $result = null;

        $table = static::getTable();
        $stmt = $db->prepare("SELECT * FROM {$table} WHERE id = ?");

        try {
            $stmt->execute([$id]);
            $result = $stmt->fetch();
        } catch (\Throwable $th) {
            throw $th;
        }

        return $result;
    }

    public static function deleteById($id) {
        $db = Database::getConnection();
        $sql = "DELETE FROM livraison WHERE id = :id";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
            return $stmt->execute(); 
        } catch (\PDOException $e) {
            error_log("Erreur suppression livraison : " . $e->getMessage());
            return false;
        }
    }


    public static function query($query){
        $db = Database::getConnection();
        $result = null;

        $stmt = $db->prepare($query);

        try {
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (\Throwable $th) {
            throw $th;
        }

        return $result;
    }
}
