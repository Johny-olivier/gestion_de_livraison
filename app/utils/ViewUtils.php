<?php

namespace app\utils;

use app\models\BaseModel;

class ViewUtils extends BaseModel {
    protected static string $table = 'vue_livraison_detail';

    public static function getFromView(string $view_name) {
        static::$table = $view_name;
        return parent::getAll();
    }
}