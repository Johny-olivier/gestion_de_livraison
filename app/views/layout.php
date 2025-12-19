<?php 
$ds = DIRECTORY_SEPARATOR;
require_once __DIR__ . $ds . ".." . $ds . "config" . $ds . "constant.php";

// Détecte si le lien est actif
function isActive($currentURI, $url) {
    if ($url === BASE_URL) {
        return $currentURI === '/' || $currentURI === BASE_URL;
    }
    return str_contains($currentURI, $url);
}

// Récupère l'URI actuelle
$currentURI = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Gestion de Livraison" ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" referrerpolicy="no-referrer" />
</head>
<body>

<!-- Menu principal -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="<?= BASE_URL ?>">
            <i class="fas fa-shipping-fast"></i> Gestion Livraison
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto">
                <?php foreach (MENU_ITEMS as $item): ?>
                    <?php if (!empty($item['dropdown'])): ?>
                        <li class="nav-item dropdown <?= array_filter($item['dropdown'], fn($sub) => isActive($currentURI, $sub['url'])) ? 'active' : '' ?>">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="<?= $item['icon'] ?>"></i> <?= $item['title'] ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <?php foreach ($item['dropdown'] as $sub): ?>
                                    <li>
                                        <a class="dropdown-item <?= isActive($currentURI, $sub['url']) ? 'active' : '' ?>" href="<?= $sub['url'] ?>">
                                            <i class="<?= $sub['icon'] ?>"></i> <?= $sub['title'] ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item <?= isActive($currentURI, $item['url']) ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= $item['url'] ?>">
                                <i class="<?= $item['icon'] ?>"></i> <?= $item['title'] ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Contenu principal -->
<div class="container mt-4">
    <?= $content ?? '' ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/layout.js"></script>

</body>
</html>
