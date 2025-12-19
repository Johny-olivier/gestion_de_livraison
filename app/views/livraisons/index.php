<?php ob_start() ?>

<!-- Header Section -->
<div class="page-header mb-5">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>" style="color: #667eea; text-decoration: none;"><i class="fas fa-home me-1"></i>Accueil</a></li>
                    <li class="breadcrumb-item active">Livraisons</li>
                </ol>
            </nav>
            <h1 class="mb-0" style="font-weight: 800; font-size: 2.5rem; color: #1a1d29;">
                <i class="fas fa-shipping-fast me-3" style="color: #667eea;"></i>Liste des Livraisons
            </h1>
            <p class="text-muted mt-2 mb-0">Gérez et suivez toutes vos livraisons en temps réel</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= BASE_URL ?>livraisons/create"
                    class="btn px-4 py-2"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                            color: white;
                            border: none;
                            border-radius: 12px;
                            font-weight: 600;
                            font-size: 1rem;
                            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">
                <i class="fas fa-plus-circle me-2"></i>Nouvelle livraison
            </a>

            <button class="btn btn-outline-secondary px-3 py-2"
                    style="border-radius: 12px;
                        font-weight: 600;
                        border-width: 2px;
                        font-size: 1rem;"
                    onclick="window.print()">
                <i class="fas fa-print"></i>
            </button>
        </div>

    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(102, 126, 234, 0.1);">
                        <i class="fas fa-box text-primary" style="font-size: 22px;"></i>
                    </div>
                    <span class="badge bg-primary bg-opacity-10 text-primary">Total</span>
                </div>
                <h3 class="mb-1 fw-bold"><?= count($livraisons) ?></h3>
                <p class="text-muted mb-0 small">Livraisons totales</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: linear-gradient(135deg, #43e97b15 0%, #38f9d715 100%);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(67, 233, 123, 0.1);">
                        <i class="fas fa-check-circle" style="font-size: 22px; color: #43e97b;"></i>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success">Livrées</span>
                </div>
                <h3 class="mb-1 fw-bold"><?= count(array_filter($livraisons, fn($l) => $l['statut'] === 'livré')) ?></h3>
                <p class="text-muted mb-0 small">Livraisons réussies</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: linear-gradient(135deg, #ffd70015 0%, #ffed4e15 100%);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(255, 215, 0, 0.1);">
                        <i class="fas fa-clock" style="font-size: 22px; color: #ffa500;"></i>
                    </div>
                    <span class="badge bg-warning bg-opacity-10 text-warning">En attente</span>
                </div>
                <h3 class="mb-1 fw-bold"><?= count(array_filter($livraisons, fn($l) => $l['statut'] === 'en attente')) ?></h3>
                <p class="text-muted mb-0 small">En cours de traitement</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: linear-gradient(135deg, #f5576c15 0%, #f093fb15 100%);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(245, 87, 108, 0.1);">
                        <i class="fas fa-exclamation-triangle" style="font-size: 22px; color: #f5576c;"></i>
                    </div>
                    <span class="badge bg-danger bg-opacity-10 text-danger">Annulé</span>
                </div>
                <h3 class="mb-1 fw-bold"><?= count(array_filter($livraisons, fn($l) => $l['statut'] === 'annulé')) ?></h3>
                <p class="text-muted mb-0 small">Nécessitent attention</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters & Search Bar -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <div class="input-group" style="border-radius: 10px; overflow: hidden;">
                    <span class="input-group-text bg-light border-0" style="border-radius: 10px 0 0 10px;">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" id="searchInput" class="form-control border-0 bg-light" placeholder="Rechercher par ID, colis, chauffeur..." style="padding: 0.75rem;">
                </div>
            </div>
            <div class="col-md-3">
                <select id="statusFilter" class="form-select border-0 bg-light" style="border-radius: 10px; padding: 0.75rem; font-weight: 500;">
                    <option value="">Tous les statuts</option>
                    <option value="livré">Livré</option>
                    <option value="en attente">En attente</option>
                    <option value="annulé">Annulé</option>
                </select>
            </div>
            <div class="col-md-3">
                <select id="sortBy" class="form-select border-0 bg-light" style="border-radius: 10px; padding: 0.75rem; font-weight: 500;">
                    <option value="date_desc">Plus récent</option>
                    <option value="date_asc">Plus ancien</option>
                    <option value="id_asc">ID croissant</option>
                    <option value="id_desc">ID décroissant</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-secondary w-100" style="border-radius: 10px; padding: 0.75rem; font-weight: 600;" onclick="resetFilters()">
                    <i class="fas fa-redo me-2"></i>Réinitialiser
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="card border-0 shadow-sm mb-5" style="border-radius: 16px; overflow: hidden;">
    <div class="table-responsive">
        <table class="table table-hover mb-0" id="livraisonsTable">
            <thead style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <tr>
                    <th scope="col" class="px-4 py-3" style="font-weight: 600; border: none;">
                        <i class="fas fa-hashtag me-2"></i>ID
                    </th>
                    <th scope="col" class="px-4 py-3" style="font-weight: 600; border: none;">
                        <i class="fas fa-box me-2"></i>Colis
                    </th>
                    <th scope="col" class="px-4 py-3" style="font-weight: 600; border: none;">
                        <i class="fas fa-user-tie me-2"></i>Chauffeur
                    </th>
                    <th scope="col" class="px-4 py-3" style="font-weight: 600; border: none;">
                        <i class="fas fa-car me-2"></i>Véhicule
                    </th>
                    <th scope="col" class="px-4 py-3" style="font-weight: 600; border: none;">
                        <i class="fas fa-map-marked-alt me-2"></i>Zone
                    </th>
                    <th scope="col" class="px-4 py-3" style="font-weight: 600; border: none;">
                        <i class="fas fa-warehouse me-2"></i>Entrepôt
                    </th>
                    <th scope="col" class="px-4 py-3" style="font-weight: 600; border: none;">
                        <i class="fas fa-info-circle me-2"></i>Statut
                    </th>
                    <th scope="col" class="px-4 py-3" style="font-weight: 600; border: none;">
                        <i class="fas fa-calendar me-2"></i>Date
                    </th>
                    <th scope="col" class="px-4 py-3 text-center" style="font-weight: 600; border: none;">
                        <i class="fas fa-cog me-2"></i>Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($livraisons)): ?>
                <tr>
                    <td colspan="9" class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-inbox" style="font-size: 4rem; color: #cbd5e0; margin-bottom: 1rem;"></i>
                            <h5 class="text-muted mb-3">Aucune livraison trouvée</h5>
                            <p class="text-muted mb-4">Commencez par créer votre première livraison</p>
                            <a href="<?= BASE_URL ?>livraisons/create" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 600;">
                                <i class="fas fa-plus-circle me-2"></i>Créer une livraison
                            </a>
                        </div>
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($livraisons as $livraison): ?>
                    <tr class="livraison-row" style="transition: all 0.3s ease;">
                        <td class="px-4 py-3 align-middle">
                            <span class="fw-bold" style="color: #667eea;">#<?= htmlspecialchars($livraison['id']) ?></span>
                        </td>
                        <td class="px-4 py-3 align-middle">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; min-width: 35px;">
                                    <i class="fas fa-box text-primary" style="font-size: 14px;"></i>
                                </div>
                                <span class="fw-semibold"><?= htmlspecialchars($livraison['colis_id']) ?></span>
                            </div>
                        </td>
                        <td class="px-4 py-3 align-middle">
                            <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 8px; font-weight: 500;">
                                <i class="fas fa-user me-1" style="font-size: 11px;"></i>
                                ID: <?= htmlspecialchars($livraison['chauffeur_id']) ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 align-middle">
                            <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 8px; font-weight: 500;">
                                <i class="fas fa-car me-1" style="font-size: 11px;"></i>
                                ID: <?= htmlspecialchars($livraison['vehicule_id']) ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 align-middle">
                            <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 8px; font-weight: 500;">
                                <i class="fas fa-map-marker-alt me-1" style="font-size: 11px;"></i>
                                Zone <?= htmlspecialchars($livraison['zone_id']) ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 align-middle">
                            <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 8px; font-weight: 500;">
                                <i class="fas fa-warehouse me-1" style="font-size: 11px;"></i>
                                E-<?= htmlspecialchars($livraison['entrepot_id']) ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 align-middle">
                            <?php if ($livraison['statut'] === 'livré'): ?>
                                <span class="badge badge-statut"
                                    data-statut="livré"
                                    style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
                                            color: white; border-radius: 10px; font-weight: 600; padding: .4rem .75rem;">
                                    <i class="fas fa-check-circle me-1"></i>livré
                                </span>

                            <?php elseif ($livraison['statut'] === 'en attente'): ?>
                                <span class="badge badge-statut"
                                    data-statut="en attente"
                                    style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
                                            color: #1a1d29; border-radius: 10px; font-weight: 600; padding: .4rem .75rem;">
                                    <i class="fas fa-clock me-1"></i>en attente
                                </span>

                            <?php else: ?>
                                <span class="badge badge-statut"
                                    data-statut="annulé"
                                    style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                                            color: white; border-radius: 10px; font-weight: 600; padding: .4rem .75rem;">
                                    <i class="fas fa-exclamation-circle me-1"></i>annulé
                                </span>
                            <?php endif; ?>
                        </td>

                        <td class="px-4 py-3 align-middle">
                            <div class="d-flex flex-column">
                                <span class="fw-semibold"><?= date('d/m/Y', strtotime($livraison['date_livraison'])) ?></span>
                                <small class="text-muted"><?= date('H:i', strtotime($livraison['date_livraison'])) ?></small>
                            </div>
                        </td>
                        <td class="px-4 py-3 align-middle">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="<?= BASE_URL ?>livraisons/show/<?= $livraison['id'] ?>" class="btn btn-sm btn-light" style="border-radius: 8px; padding: 0.4rem 0.8rem;" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= BASE_URL ?>livraisons/update/<?= $livraison['id'] ?>" class="btn btn-sm btn-light" style="border-radius: 8px; padding: 0.4rem 0.8rem;" title="Modifier">
                                    <i class="fas fa-edit text-primary"></i>
                                </a>
                                <button onclick="confirmDelete(<?= $livraison['id'] ?>)" class="btn btn-sm btn-light" style="border-radius: 8px; padding: 0.4rem 0.8rem;" title="Supprimer">
                                    <i class="fas fa-trash-alt text-danger"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination (si nécessaire)
<div class="d-flex justify-content-between align-items-center mt-4">
    <p class="text-muted mb-0">Affichage de <strong><?= count($livraisons) ?></strong> livraisons</p>
    <nav aria-label="Pagination">
        <ul class="pagination mb-0">
            <li class="page-item disabled">
                <a class="page-link" href="#" style="border-radius: 10px 0 0 10px;">Précédent</a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">1</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" style="border-radius: 0 10px 10px 0;">Suivant</a>
            </li>
        </ul>
    </nav>
</div> -->

<script>
    // --- Confirmation suppression ---
    function confirmDelete(id) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette livraison ?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "<?= BASE_URL ?>livraisons/delete/" + id;
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>

<script src="<?= BASE_URL ?>assets/js/livraisons/index.js"></script>



<?php 
$content = ob_get_clean();
$title = "Liste des Livraisons - Gestion de Livraison";
require __DIR__ . '/../layout.php';