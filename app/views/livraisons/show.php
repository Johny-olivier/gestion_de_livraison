<?php ob_start() ?>

<!-- Header Section -->
<div class="page-header mb-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>" style="color: #667eea; text-decoration: none;"><i class="fas fa-home me-1"></i>Accueil</a></li>
            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>livraisons" style="color: #667eea; text-decoration: none;">Livraisons</a></li>
            <li class="breadcrumb-item active">Livraison #<?= $livraison['id'] ?></li>
        </ol>
    </nav>
    <h1 class="mb-0" style="font-weight: 800; font-size: 2.5rem; color: #1a1d29;">
        <i class="fas fa-eye me-3" style="color: #667eea;"></i>Détails de la Livraison
    </h1>
    <p class="text-muted mt-2 mb-0">Informations complètes pour la livraison #<?= $livraison['id'] ?></p>
</div>

<div class="row g-4 mb-5">
    <!-- Détails Principaux -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header border-0 py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h5 class="mb-0 text-white fw-bold">
                    <i class="fas fa-info-circle me-2"></i>Informations de la Livraison
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <strong><i class="fas fa-barcode me-2 text-primary"></i>ID Colis :</strong>
                    Colis N°<?= $livraison['colis_id'] ?>
                </div>
                <div class="mb-3">
                    <strong><i class="fas fa-user-tie me-2" style="color: #f5576c;"></i>Chauffeur :</strong>
                    <?= $livraison['chauffeur_nom'] ?> (ID : <?= $livraison['chauffeur_id'] ?>)
                </div>
                <div class="mb-3">
                    <strong><i class="fas fa-car me-2" style="color: #f5576c;"></i>Véhicule :</strong>
                    <?= $livraison['vehicule_immatriculation'] ?> (ID : <?= $livraison['vehicule_id'] ?>)
                </div>
                <div class="mb-3">
                    <strong><i class="fas fa-map-marker-alt me-2 text-info"></i>Zone de Livraison :</strong>
                    <?= $livraison['zone_nom'] ?> (ID : <?= $livraison['zone_id'] ?>)
                </div>
                <div class="mb-3">
                    <strong><i class="fas fa-warehouse me-2 text-info"></i>Entrepôt :</strong>
                    <?= $livraison['entrepot_nom'] ?> (Adresse : <?= $livraison['entrepot_adresse'] ?>)
                </div>
                <div class="mb-3">
                    <strong><i class="fas fa-calendar-alt me-2 text-success"></i>Date de Livraison :</strong>
                    <?= date('d/m/Y H:i', strtotime($livraison['date_livraison'])) ?>
                </div>
                <div class="mb-3">
                    <strong><i class="fas fa-info-circle me-2 text-success"></i>Statut :</strong>
                    <?= ucfirst($livraison['statut']) ?>
                </div>

                <!-- Boutons -->
                <div class="d-flex gap-2 mt-4">
                    <a href="<?= BASE_URL ?>livraisons" class="btn btn-outline-secondary" style="border-radius: 12px; font-weight: 600; padding: 0.5rem 1rem;">
                        <i class="fas fa-arrow-left me-2"></i>Retour
                    </a>
                    <a href="<?= BASE_URL ?>livraisons/update/<?= $livraison['id'] ?>" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 12px; font-weight: 600; padding: 0.5rem 1rem;">
                        <i class="fas fa-edit me-2"></i>Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Aide & Conseils -->
    <div class="col-lg-4">
        <!-- Card Aide -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-lightbulb text-white"></i>
                    </div>
                    <h6 class="mb-0 fw-bold">Conseils Rapides</h6>
                </div>
                <ul class="list-unstyled mb-0">
                    <li class="mb-3 d-flex">
                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                        <small class="text-muted">Vérifiez la disponibilité du chauffeur avant affectation</small>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                        <small class="text-muted">Assurez-vous que le véhicule peut supporter le poids</small>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                        <small class="text-muted">Planifiez avec au moins 2h d'avance</small>
                    </li>
                    <li class="d-flex">
                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                        <small class="text-muted">Ajoutez des notes pour instructions spéciales</small>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Card Statistiques -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-chart-pie me-2 text-primary"></i>Statistiques du Jour
                </h6>
                <div class="mb-3 pb-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Livraisons créées</span>
                        <span class="fw-bold fs-5"><?= count($livraisons) ?></span>
                    </div>
                </div>
                <div class="mb-3 pb-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Chauffeurs actifs</span>
                        <span class="fw-bold fs-5"><?= $chauffeurs_actifs ?></span>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Véhicules disponibles</span>
                        <span class="fw-bold fs-5"><?= $vehicules_disponibles ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Raccourcis -->
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-link me-2 text-info"></i>Raccourcis Utiles
                </h6>
                <div class="d-grid gap-2">
                    <a href="<?= BASE_URL ?>chauffeurs" class="btn btn-light text-start" style="border-radius: 10px; padding: 0.5rem;">
                        <i class="fas fa-user-tie me-2 text-primary"></i>Gérer les chauffeurs
                    </a>
                    <a href="<?= BASE_URL ?>vehicules" class="btn btn-light text-start" style="border-radius: 10px; padding: 0.5rem;">
                        <i class="fas fa-car me-2 text-danger"></i>Gérer les véhicules
                    </a>
                    <a href="<?= BASE_URL ?>entrepots" class="btn btn-light text-start" style="border-radius: 10px; padding: 0.5rem;">
                        <i class="fas fa-warehouse me-2 text-info"></i>Gérer les entrepôts
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>
