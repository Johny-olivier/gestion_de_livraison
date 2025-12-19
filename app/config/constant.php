<?php

define("BASE_URL", "/ETU004282/gestion-livraison/");

// Tableau des menus principaux
$menuItems = [
    [
        'title' => 'Accueil',
        'url' => BASE_URL,
        'icon' => 'fas fa-home'
    ],
    [
        'title' => 'Livraisons',
        'icon' => 'fas fa-shipping-fast',
        'dropdown' => [
            ['title' => 'Liste des livraisons', 'url' => BASE_URL . 'livraisons', 'icon' => 'fas fa-list'],
            ['title' => 'Ajouter une livraison', 'url' => BASE_URL . 'livraisons/create', 'icon' => 'fas fa-plus-circle']
        ]
    ],
    [
        'title' => 'Chauffeurs',
        'icon' => 'fas fa-user-tie',
        'dropdown' => [
            ['title' => 'Liste des chauffeurs', 'url' => BASE_URL . 'chauffeurs', 'icon' => 'fas fa-list'],
            ['title' => 'Ajouter un chauffeur', 'url' => BASE_URL . 'chauffeurs/create', 'icon' => 'fas fa-plus-circle']
        ]
    ],
    [
        'title' => 'Véhicules',
        'icon' => 'fas fa-car',
        'dropdown' => [
            ['title' => 'Liste des véhicules', 'url' => BASE_URL . 'vehicules', 'icon' => 'fas fa-list'],
            ['title' => 'Ajouter un véhicule', 'url' => BASE_URL . 'vehicules/create', 'icon' => 'fas fa-plus-circle']
        ]
    ],
    [
        'title' => 'Entrepôts',
        'icon' => 'fas fa-warehouse',
        'dropdown' => [
            ['title' => 'Liste des entrepôts', 'url' => BASE_URL . 'entrepots', 'icon' => 'fas fa-list'],
            ['title' => 'Ajouter un entrepôt', 'url' => BASE_URL . 'entrepots/create', 'icon' => 'fas fa-plus-circle']
        ]
    ],
    [
        'title' => 'Zones de livraison',
        'icon' => 'fas fa-map-marker-alt',
        'dropdown' => [
            ['title' => 'Liste des zones', 'url' => BASE_URL . 'zones', 'icon' => 'fas fa-list'],
            ['title' => 'Ajouter une zone', 'url' => BASE_URL . 'zones/create', 'icon' => 'fas fa-plus-circle']
        ]
    ],
    [
        'title' => 'Colis',
        'icon' => 'fas fa-box',
        'dropdown' => [
            ['title' => 'Liste des colis', 'url' => BASE_URL . 'colis', 'icon' => 'fas fa-list'],
            ['title' => 'Ajouter un colis', 'url' => BASE_URL . 'colis/create', 'icon' => 'fas fa-plus-circle']
        ]
    ],
    [
        'title' => 'Paramètres',
        'icon' => 'fas fa-cog',
        'dropdown' => [
            ['title' => 'Liste des paramètres', 'url' => BASE_URL . 'parametres', 'icon' => 'fas fa-list'],
            ['title' => 'Ajouter un paramètre', 'url' => BASE_URL . 'parametres/create', 'icon' => 'fas fa-plus-circle']
        ]
    ],
    [
        'title' => 'Bénéfices',
        'url' => BASE_URL . 'benefices',
        'icon' => 'fas fa-chart-line'
    ]
];


define("MENU_ITEMS", $menuItems);
