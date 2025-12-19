<?php ob_start() ?>

<!-- Hero Section Modernisé -->
<div class="bg-gradient-primary text-white py-5 mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 24px;">
    <div class="container">
        <div class="row align-items-center py-4">
            <div class="col-lg-8 mx-auto text-center">
                <span class="badge bg-white text-primary px-3 py-2 mb-3" style="font-size: 0.875rem; border-radius: 20px;">
                    <i class="fas fa-truck me-2"></i>Système de Gestion Intelligent
                </span>
                <h1 class="display-3 fw-bold mb-4" style="font-weight: 800;">Gestion de Livraison</h1>
                <p class="lead mb-4 opacity-90" style="font-size: 1.25rem;">
                    Pilotez vos opérations logistiques en temps réel. Optimisez vos livraisons, 
                    gérez vos équipes et maximisez vos bénéfices avec notre plateforme intuitive.
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap mt-4">
                    <a class="btn btn-light btn-lg px-4 py-3 shadow-sm" href="<?= BASE_URL ?>livraisons" role="button" style="border-radius: 12px; font-weight: 600;">
                        <i class="fas fa-box me-2"></i>Voir les livraisons
                    </a>
                    <a class="btn btn-outline-light btn-lg px-4 py-3" href="<?= BASE_URL ?>benefices" role="button" style="border-radius: 12px; font-weight: 600; border-width: 2px;">
                        <i class="fas fa-chart-line me-2"></i>Analyser les bénéfices
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section Statistiques Rapides -->
<div class="container mb-5">
    <div class="row g-4 mb-5">
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);">
                <div class="card-body text-center p-4">
                    <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-shipping-fast text-primary" style="font-size: 24px;"></i>
                    </div>
                    <h3 class="fw-bold mb-1"><?= $stats["livraisons_actives"] ?></h3>
                    <p class="text-muted mb-0 small">Livraisons actives</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: linear-gradient(135deg, #f093fb15 0%, #f5576c15 100%);">
                <div class="card-body text-center p-4">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; background: rgba(245, 87, 108, 0.1);">
                        <i class="fas fa-user-check" style="font-size: 24px; color: #f5576c;"></i>
                    </div>
                    <h3 class="fw-bold mb-1"><?= $stats["chauffeurs_actifs"] ?></h3>
                    <p class="text-muted mb-0 small">Chauffeurs actifs</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: linear-gradient(135deg, #4facfe15 0%, #00f2fe15 100%);">
                <div class="card-body text-center p-4">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; background: rgba(79, 172, 254, 0.1);">
                        <i class="fas fa-truck-moving" style="font-size: 24px; color: #4facfe;"></i>
                    </div>
                    <h3 class="fw-bold mb-1"><?= $stats["vehicules_en_route"] ?></h3>
                    <p class="text-muted mb-0 small">Véhicules en route</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: linear-gradient(135deg, #43e97b15 0%, #38f9d715 100%);">
                <div class="card-body text-center p-4">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; background: rgba(67, 233, 123, 0.1);">
                        <i class="fas fa-dollar-sign" style="font-size: 24px; color: #43e97b;"></i>
                    </div>
                    <h3 class="fw-bold mb-1"><?= $stats["taux_satisfaction"] ?>%</h3>
                    <p class="text-muted mb-0 small">Taux de satisfaction</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Titre des Modules -->
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-3" style="font-size: 2.5rem;">Modules de Gestion</h2>
        <p class="text-muted lead">Accédez rapidement à tous vos outils de gestion</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 hover-lift" style="border-radius: 20px; transition: all 0.3s ease; overflow: hidden;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 56px; height: 56px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <i class="fas fa-user-tie text-white" style="font-size: 24px;"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1 fw-bold">Chauffeurs</h5>
                            <span class="badge bg-success bg-opacity-10 text-success small"><?= $stats["chauffeurs_actifs"] ?> actifs</span>
                        </div>
                    </div>
                    <p class="card-text text-muted mb-4">
                        Gérez vos chauffeurs, suivez leurs performances et optimisez les affectations aux livraisons en temps réel.
                    </p>
                    <a href="<?= BASE_URL ?>chauffeurs" class="btn btn-primary w-100 py-3" style="border-radius: 12px; font-weight: 600;">
                        <i class="fas fa-arrow-right me-2"></i>Gérer les chauffeurs
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 hover-lift" style="border-radius: 20px; transition: all 0.3s ease; overflow: hidden;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 56px; height: 56px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                            <i class="fas fa-car text-white" style="font-size: 24px;"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1 fw-bold">Véhicules</h5>
                            <span class="badge bg-info bg-opacity-10 text-info small"><?= $stats["vehicules_en_route"] ?> en route</span>
                        </div>
                    </div>
                    <p class="card-text text-muted mb-4">
                        Administrez votre flotte de véhicules, suivez les coûts par livraison et optimisez l'utilisation de vos ressources.
                    </p>
                    <a href="<?= BASE_URL ?>vehicules" class="btn w-100 py-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border-radius: 12px; font-weight: 600; border: none;">
                        <i class="fas fa-arrow-right me-2"></i>Gérer les véhicules
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 hover-lift" style="border-radius: 20px; transition: all 0.3s ease; overflow: hidden;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 56px; height: 56px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                            <i class="fas fa-warehouse text-white" style="font-size: 24px;"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1 fw-bold">Entrepôts & Zones</h5>
                            <span class="badge bg-warning bg-opacity-10 text-warning small"><?= $stats["nb_sites"] ?> sites</span>
                        </div>
                    </div>
                    <p class="card-text text-muted mb-4">
                        Organisez vos entrepôts et zones de livraison pour une logistique optimale et une couverture territoriale efficace.
                    </p>
                    <a href="<?= BASE_URL ?>entrepots" class="btn w-100 py-3" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border-radius: 12px; font-weight: 600; border: none;">
                        <i class="fas fa-arrow-right me-2"></i>Gérer les entrepôts
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section CTA Finale -->
<div class="container my-5">
    <div class="card border-0 shadow-lg" style="border-radius: 24px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); overflow: hidden;">
        <div class="card-body p-5 text-center text-white">
            <h3 class="fw-bold mb-3">Besoin d'aide pour démarrer ?</h3>
            <p class="lead mb-4 opacity-90">Notre équipe support est disponible 24/7 pour vous accompagner</p>
            <a href="<?= BASE_URL ?>support" class="btn btn-light btn-lg px-5 py-3" style="border-radius: 12px; font-weight: 600;">
                <i class="fas fa-headset me-2"></i>Contacter le support
            </a>
        </div>
    </div>
</div>


<?php 
$content = ob_get_clean();
require __DIR__ . '/layout.php';