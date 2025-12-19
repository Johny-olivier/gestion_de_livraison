<?php ob_start() ?>

<!-- Header Section -->
<div class="page-header mb-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>" style="color: #667eea; text-decoration: none;"><i class="fas fa-home me-1"></i>Accueil</a></li>
            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>livraisons" style="color: #667eea; text-decoration: none;">Livraisons</a></li>
            <li class="breadcrumb-item active">Nouvelle livraison</li>
        </ol>
    </nav>
    <h1 class="mb-0" style="font-weight: 800; font-size: 2.5rem; color: #1a1d29;">
        <i class="fas fa-plus-circle me-3" style="color: #667eea;"></i>Créer une Livraison
    </h1>
    <p class="text-muted mt-2 mb-0">Remplissez les informations pour créer une nouvelle livraison</p>
</div>

<div class="row g-4 mb-5">
    <!-- Formulaire Principal -->
    <div class="col-lg-8">

        <?php if(count($data["colis"]) == 0): ?>
            <!-- Message si aucun colis disponible -->
            <div class="alert alert-warning p-4" style="border-radius: 20px; font-weight: 600;">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Aucun colis disponible pour la livraison. Veuillez ajouter des colis avant de créer une livraison.
            </div>
        <?php else: ?>
            <!-- Formulaire existant -->
            <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
                <!-- Card Header -->
                <div class="card-header border-0 py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h5 class="mb-0 text-white fw-bold">
                        <i class="fas fa-clipboard-list me-2"></i>Informations de la Livraison
                    </h5>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">
                    <form action="<?= BASE_URL ?>livraisons/create" method="POST" id="livraisonForm">

                        <!-- Section Colis -->
                        <div class="form-section">
                            <div class="mb-3">
                                <label for="colis_id" class="form-label fw-semibold">
                                    <i class="fas fa-barcode me-2 text-primary"></i>ID Colis
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" 
                                        id="colis_id" 
                                        name="colis_id" 
                                        required
                                        style="border-radius: 12px; border: 2px solid #e2e8f0; padding: 0.5rem 0.75rem;">
                                    <option value="">Sélectionnez un colis</option>
                                    <?php foreach ($data["colis"] as $coli): ?>
                                        <option value="<?= $coli["id"] ?>">Colis N°<?= $coli["id"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Section Affectation -->
                        <div class="form-section">
                            <div class="mb-3">
                                <label for="chauffeur_id" class="form-label fw-semibold">
                                    <i class="fas fa-user-tie me-2" style="color: #f5576c;"></i>Chauffeur
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" 
                                        id="chauffeur_id" 
                                        name="chauffeur_id" 
                                        required
                                        style="border-radius: 12px; border: 2px solid #e2e8f0; padding: 0.5rem 0.75rem;">
                                    <option value="">Sélectionnez un chauffeur</option>
                                    <?php foreach ($data["chauffeurs"] as $chauffeur): ?>
                                        <option value="<?= $chauffeur["id"] ?>"><?= $chauffeur["nom"] ?> (ID : <?= $chauffeur["id"] ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="vehicule_id" class="form-label fw-semibold">
                                    <i class="fas fa-car me-2" style="color: #f5576c;"></i>Véhicule
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" 
                                        id="vehicule_id" 
                                        name="vehicule_id" 
                                        required
                                        style="border-radius: 12px; border: 2px solid #e2e8f0; padding: 0.5rem 0.75rem;">
                                    <?php foreach ($data["vehicules"] as $vehicule): ?>
                                        <option value="<?= $vehicule["id"] ?>"><?= $vehicule["immatriculation"] ?> (ID : <?= $vehicule["id"] ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Section Localisation -->
                        <div class="form-section">
                            <div class="mb-3">
                                <label for="zone_id" class="form-label fw-semibold">
                                    <i class="fas fa-map-marker-alt me-2 text-info"></i>Zone de Livraison
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" 
                                        id="zone_id" 
                                        name="zone_id" 
                                        required
                                        style="border-radius: 12px; border: 2px solid #e2e8f0; padding: 0.5rem 0.75rem;">
                                    <option value="">Sélectionnez une zone</option>
                                    <?php foreach ($data["zone_livraisons"] as $zone): ?>
                                        <option value="<?= $zone["id"] ?>"><?= $zone["nom"] ?> (ID : <?= $zone["id"] ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="entrepot_id" class="form-label fw-semibold">
                                    <i class="fas fa-warehouse me-2 text-info"></i>Entrepôt de Départ
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" 
                                        id="entrepot_id" 
                                        name="entrepot_id" 
                                        required
                                        style="border-radius: 12px; border: 2px solid #e2e8f0; padding: 0.5rem 0.75rem;">
                                    <option value="">Sélectionnez un entrepôt</option>
                                    <?php foreach ($data["entrepots"] as $entrepot): ?>
                                        <option value="<?= $entrepot["id"] ?>"><?= $entrepot["nom"] ?> (adresse : <?= $entrepot["adresse"] ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Section Planification -->
                        <div class="form-section mb-4">
                            <div class="mb-3">
                                <label for="date_livraison" class="form-label fw-semibold">
                                    <i class="fas fa-calendar-alt me-2 text-success"></i>Date de Livraison
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="datetime-local" 
                                       class="form-control" 
                                       id="date_livraison" 
                                       name="date_livraison" 
                                       required
                                       style="border-radius: 12px; border: 2px solid #e2e8f0; padding: 0.5rem 0.75rem;">
                            </div>

                            <div class="mb-3">
                                <label for="statut" class="form-label fw-semibold">
                                    <i class="fas fa-info-circle me-2 text-success"></i>Statut Initial
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" 
                                        id="statut" 
                                        name="statut" 
                                        required
                                        style="border-radius: 12px; border: 2px solid #e2e8f0; padding: 0.5rem 0.75rem;">
                                    <option value="en attente" selected>En attente</option>
                                    <option value="livré">Livré</option>
                                    <option value="annulé">Annulé</option>
                                </select>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex gap-2 justify-content-end mt-4">
                            <a href="<?= BASE_URL ?>livraisons" class="btn btn-outline-secondary" style="border-radius: 12px; font-weight: 600; padding: 0.5rem 1rem;">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                            <button type="submit" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 12px; font-weight: 600; padding: 0.5rem 1rem;">
                                <i class="fas fa-check-circle me-2"></i>Créer la livraison
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        <?php endif; ?>

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
                        <span class="fw-bold fs-5"><?= count($data['livraisons']) ?></span>
                    </div>
                </div>
                <div class="mb-3 pb-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Chauffeurs actifs</span>
                        <span class="fw-bold fs-5"><?= $data['chauffeurs_actifs'] ?></span>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Véhicules disponibles</span>
                        <span class="fw-bold fs-5"><?= $data['vehicules_disponibles'] ?></span>
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

<script src="<?= BASE_URL ?>assets/js/livraisons/create.js"></script>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../layout.php';