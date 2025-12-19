<?php ob_start() ?>

<!-- Header Section -->
<div class="page-header mb-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>" style="color: #667eea; text-decoration: none;"><i class="fas fa-home me-1"></i>Accueil</a></li>
            <li class="breadcrumb-item active">Bénéfices</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1 class="mb-0" style="font-weight: 800; font-size: 2.5rem; color: #1a1d29;">
                <i class="fas fa-chart-line me-3" style="color: #43e97b;"></i>Analyse des Bénéfices
            </h1>
            <p class="text-muted mt-2 mb-0">Visualisez vos performances financières en temps réel</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary px-3 py-2" style="border-radius: 10px; font-weight: 600; border-width: 2px;" onclick="window.print()">
                <i class="fas fa-print me-2"></i>Imprimer
            </button>
            <button class="btn btn-outline-primary px-3 py-2" style="border-radius: 10px; font-weight: 600; border-width: 2px;" onclick="exportData()">
                <i class="fas fa-download me-2"></i>Exporter
            </button>
        </div>
    </div>
</div>

<!-- Statistiques Globales -->
<?php 
$stats = $stats ?? [];
$total_ca = $stats['ca_total'] ?? 0;
$total_cout = $stats['cout_total'] ?? 0;
$total_benefice = $stats['benefice_total'] ?? 0;
$marge = $total_ca > 0 ? round(($total_benefice / $total_ca) * 100, 2) : 0;
?>

<div class="row g-4 mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: linear-gradient(135deg, #43e97b15 0%, #38f9d715 100%); overflow: hidden;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                        <i class="fas fa-dollar-sign text-white" style="font-size: 24px;"></i>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                        <i class="fas fa-arrow-up me-1"></i>Total
                    </span>
                </div>
                <h3 class="mb-1 fw-bold" style="font-size: 2rem; color: #43e97b;"><?= number_format($total_benefice, 0, ',', ' ') ?> Ar</h3>
                <p class="text-muted mb-0">Bénéfice Total</p>
                <div class="progress mt-3" style="height: 6px; border-radius: 10px;">
                    <div class="progress-bar" style="background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%); width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%); overflow: hidden;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-chart-line text-white" style="font-size: 24px;"></i>
                    </div>
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">CA</span>
                </div>
                <h3 class="mb-1 fw-bold" style="font-size: 2rem; color: #667eea;"><?= number_format($total_ca, 0, ',', ' ') ?> Ar</h3>
                <p class="text-muted mb-0">Chiffre d'Affaires</p>
                <div class="progress mt-3" style="height: 6px; border-radius: 10px;">
                    <div class="progress-bar" style="background: linear-gradient(90deg, #667eea 0%, #764ba2 100%); width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: linear-gradient(135deg, #f5576c15 0%, #f093fb15 100%); overflow: hidden;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px; background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);">
                        <i class="fas fa-money-bill-wave text-white" style="font-size: 24px;"></i>
                    </div>
                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">Coûts</span>
                </div>
                <h3 class="mb-1 fw-bold" style="font-size: 2rem; color: #f5576c;"><?= number_format($total_cout, 0, ',', ' ') ?> Ar</h3>
                <p class="text-muted mb-0">Coûts de Revient</p>
                <div class="progress mt-3" style="height: 6px; border-radius: 10px;">
                    <div class="progress-bar" style="background: linear-gradient(90deg, #f5576c 0%, #f093fb 100%); width: <?= $total_ca > 0 ? ($total_cout / $total_ca * 100) : 0 ?>%;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: linear-gradient(135deg, #4facfe15 0%, #00f2fe15 100%); overflow: hidden;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <i class="fas fa-percentage text-white" style="font-size: 24px;"></i>
                    </div>
                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">Marge</span>
                </div>
                <h3 class="mb-1 fw-bold" style="font-size: 2rem; color: #4facfe;"><?= $marge ?>%</h3>
                <p class="text-muted mb-0">Marge Bénéficiaire</p>
                <div class="progress mt-3" style="height: 6px; border-radius: 10px;">
                    <div class="progress-bar" style="background: linear-gradient(90px, #4facfe 0%, #00f2fe 100%); width: <?= $marge ?>%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filtres de Période -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-4">
        <form method="GET" action="<?= BASE_URL ?>benefices" id="filterForm">
            <div class="row g-3 align-items-end">

                <div class="col-md-3">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-filter me-2 text-primary"></i>Type de période
                    </label>
                    <select name="type" id="typeFilter"
                            class="form-select"
                            style="border-radius: 10px; border: 2px solid #e2e8f0; font-size: 0.95rem;"
                            onchange="updateFilters()">
                        <option value="mois" <?= ($type ?? 'mois') === 'mois' ? 'selected' : '' ?>>Par Mois</option>
                        <option value="annee" <?= ($type ?? '') === 'annee' ? 'selected' : '' ?>>Par Année</option>
                        <option value="jour" <?= ($type ?? '') === 'jour' ? 'selected' : '' ?>>Par Jour</option>
                    </select>
                </div>

                <div class="col-md-2" id="anneeFilter">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-calendar-alt me-2 text-primary"></i>Année
                    </label>
                    <select name="annee"
                            class="form-select"
                            style="border-radius: 10px; border: 2px solid #e2e8f0; font-size: 0.95rem;">
                        <?php for($y = date('Y'); $y >= 2020; $y--): ?>
                            <option value="<?= $y ?>" <?= ($annee ?? date('Y')) == $y ? 'selected' : '' ?>><?= $y ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-2" id="moisFilter"
                     style="display: <?= ($type ?? 'mois') === 'jour' ? 'block' : 'none' ?>;">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-calendar me-2 text-primary"></i>Mois
                    </label>
                    <select name="mois"
                            class="form-select"
                            style="border-radius: 10px; border: 2px solid #e2e8f0; font-size: 0.95rem;">
                        <?php
                        $mois_noms = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
                        for($m = 1; $m <= 12; $m++):
                        ?>
                            <option value="<?= $m ?>" <?= ($mois ?? date('n')) == $m ? 'selected' : '' ?>>
                                <?= $mois_noms[$m-1] ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-2" id="jourFilter"
                     style="display: <?= ($type ?? 'mois') === 'jour' ? 'block' : 'none' ?>;">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-calendar-day me-2 text-primary"></i>Jour
                    </label>
                    <select name="jour"
                            class="form-select"
                            style="border-radius: 10px; border: 2px solid #e2e8f0; font-size: 0.95rem;">
                        <?php for($d = 1; $d <= 31; $d++): ?>
                            <option value="<?= $d ?>" <?= ($jour ?? date('j')) == $d ? 'selected' : '' ?>><?= $d ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <button type="submit"
                            class="btn w-100 py-2"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                   color: white;
                                   border: none;
                                   border-radius: 10px;
                                   font-weight: 600;
                                   font-size: 0.95rem;">
                        <i class="fas fa-search me-2"></i>Filtrer
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- Graphique et Tableau -->
<div class="row g-4">
    <!-- Graphique -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white border-0 py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-chart-bar me-2 text-primary"></i>Évolution des Bénéfices
                    </h5>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="changeChartType('bar')">
                            <i class="fas fa-chart-bar"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-primary active" onclick="changeChartType('line')">
                            <i class="fas fa-chart-line"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="changeChartType('area')">
                            <i class="fas fa-chart-area"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <canvas id="beneficeChart" style="max-height: 400px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Résumé & Insights -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%);">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-lightbulb me-2 text-warning"></i>Insights & Analyses
                </h6>
                
                <?php 
                $resultats = $resultats ?? [];
                if (!empty($resultats)) {
                    $benefices = array_column($resultats, 'benefice_total');
                    $meilleur = max($benefices);
                    $pire = min($benefices);
                    $moyenne = array_sum($benefices) / count($benefices);
                    $meilleur_index = array_search($meilleur, $benefices);
                    $pire_index = array_search($pire, $benefices);
                ?>
                
                <div class="mb-3 pb-3 border-bottom">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-trophy text-warning me-2"></i>
                        <small class="text-muted">Meilleure période</small>
                    </div>
                    <div class="fw-bold text-success"><?= $resultats[$meilleur_index]['periode'] ?></div>
                    <div class="fw-bold"><?= number_format($meilleur, 0, ',', ' ') ?> Ar</div>
                </div>

                <div class="mb-3 pb-3 border-bottom">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-chart-line text-primary me-2"></i>
                        <small class="text-muted">Moyenne</small>
                    </div>
                    <div class="fw-bold"><?= number_format($moyenne, 0, ',', ' ') ?> Ar</div>
                </div>

                <div class="mb-3 pb-3 border-bottom">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                        <small class="text-muted">Période la plus faible</small>
                    </div>
                    <div class="fw-bold text-danger"><?= $resultats[$pire_index]['periode'] ?></div>
                    <div class="fw-bold"><?= number_format($pire, 0, ',', ' ') ?> Ar</div>
                </div>

                <div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-calendar-check text-info me-2"></i>
                        <small class="text-muted">Périodes analysées</small>
                    </div>
                    <div class="fw-bold"><?= count($resultats) ?></div>
                </div>

                <?php } else { ?>
                    <p class="text-muted mb-0">Aucune donnée disponible pour cette période.</p>
                <?php } ?>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-bolt me-2 text-warning"></i>Actions Rapides
                </h6>
                <div class="d-grid gap-2">
                    <a href="<?= BASE_URL ?>livraisons" class="btn btn-light text-start" style="border-radius: 10px; padding: 0.75rem;">
                        <i class="fas fa-shipping-fast me-2 text-primary"></i>Voir les livraisons
                    </a>
                    <a href="<?= BASE_URL ?>parametres" class="btn btn-light text-start" style="border-radius: 10px; padding: 0.75rem;">
                        <i class="fas fa-cog me-2 text-secondary"></i>Paramètres
                    </a>
                    <button onclick="exportData()" class="btn btn-light text-start" style="border-radius: 10px; padding: 0.75rem;">
                        <i class="fas fa-file-excel me-2 text-success"></i>Exporter en Excel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tableau Détaillé -->
<div class="card border-0 shadow-sm mt-4" style="border-radius: 16px; margin-bottom: 20px;">
    <div class="card-header bg-white border-0 py-4">
        <h5 class="mb-0 fw-bold">
            <i class="fas fa-table me-2 text-primary"></i>Détails par Période
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <tr>
                        <th class="px-4 py-3" style="border: none; font-weight: 600;">
                            <i class="fas fa-calendar me-2"></i>Période
                        </th>
                        <th class="px-4 py-3 text-end" style="border: none; font-weight: 600;">
                            <i class="fas fa-dollar-sign me-2"></i>Bénéfice
                        </th>
                        <th class="px-4 py-3 text-center" style="border: none; font-weight: 600;">
                            <i class="fas fa-chart-pie me-2"></i>Performance
                        </th>
                        <th class="px-4 py-3 text-center" style="border: none; font-weight: 600;">
                            <i class="fas fa-cog me-2"></i>Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($resultats)): ?>
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <i class="fas fa-inbox" style="font-size: 3rem; color: #cbd5e0; margin-bottom: 1rem;"></i>
                            <p class="text-muted mb-0">Aucun bénéfice trouvé pour cette période</p>
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php 
                        $benefices = array_column($resultats, 'benefice_total');
                        $max_benefice = max($benefices);
                        foreach ($resultats as $index => $resultat): 
                            $benefice = $resultat['benefice_total'];
                            $pourcentage = $max_benefice > 0 ? ($benefice / $max_benefice * 100) : 0;
                        ?>
                        <tr style="transition: all 0.3s ease;">
                            <td class="px-4 py-3 align-middle">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; min-width: 40px;">
                                        <i class="fas fa-calendar-day text-primary"></i>
                                    </div>
                                    <span class="fw-semibold"><?= htmlspecialchars($resultat['periode']) ?></span>
                                </div>
                            </td>
                            <td class="px-4 py-3 align-middle text-end">
                                <span class="fw-bold fs-5" style="color: <?= $benefice >= 0 ? '#43e97b' : '#f5576c' ?>;">
                                    <?= number_format($benefice, 0, ',', ' ') ?> Ar
                                </span>
                            </td>
                            <td class="px-4 py-3 align-middle">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <div class="progress" style="height: 8px; width: 120px; border-radius: 10px;">
                                        <div class="progress-bar" style="background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%); width: <?= $pourcentage ?>%;"></div>
                                    </div>
                                    <small class="text-muted fw-semibold"><?= round($pourcentage) ?>%</small>
                                </div>
                            </td>
                            <td class="px-4 py-3 align-middle text-center">
                                <button class="btn btn-sm btn-light" style="border-radius: 8px;" title="Voir détails" onclick="alert('Fonctionnalité à venir')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Données pour le graphique
    const chartData = {
        labels: <?= json_encode(array_column($resultats ?? [], 'periode')) ?>,
        datasets: [{
            label: 'Bénéfice (Ar)',
            data: <?= json_encode(array_column($resultats ?? [], 'benefice_total')) ?>,
            backgroundColor: 'rgba(67, 233, 123, 0.2)',
            borderColor: 'rgba(67, 233, 123, 1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointRadius: 6,
            pointHoverRadius: 10,
            pointBackgroundColor: '#43e97b',
            pointBorderColor: '#fff',
            pointBorderWidth: 3,
            pointHoverBackgroundColor: '#43e97b',
            pointHoverBorderColor: '#fff'
        }]
    };

    // Configuration du graphique
    const config = {
        type: 'line',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(26, 29, 41, 0.95)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#667eea',
                    borderWidth: 2,
                    padding: 15,
                    cornerRadius: 10,
                    displayColors: false,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    callbacks: {
                        label: function(context) {
                            return 'Bénéfice: ' + new Intl.NumberFormat('fr-FR').format(context.parsed.y) + ' Ar';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        },
                        callback: function(value) {
                            return new Intl.NumberFormat('fr-FR', {
                                notation: 'compact',
                                compactDisplay: 'short'
                            }).format(value) + ' Ar';
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: '500'
                        }
                    }
                }
            }
        }
    };

    // Initialisation du graphique
    const ctx = document.getElementById('beneficeChart');
    let beneficeChart = new Chart(ctx, config);

    // Fonction pour changer le type de graphique
    function changeChartType(type) {
        // Retirer la classe active de tous les boutons
        document.querySelectorAll('.btn-group button').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Ajouter la classe active au bouton cliqué
        event.target.closest('button').classList.add('active');
        
        // Détruire et recréer le graphique
        beneficeChart.destroy();
        
        if (type === 'area') {
            config.type = 'line';
            config.data.datasets[0].fill = true;
        } else {
            config.type = type;
            config.data.datasets[0].fill = (type === 'line');
        }
        
        beneficeChart = new Chart(ctx, config);
    }

    // Fonction pour mettre à jour les filtres
    function updateFilters() {
        const type = document.getElementById('typeFilter').value;
        const moisFilter = document.getElementById('moisFilter');
        const jourFilter = document.getElementById('jourFilter');
        const anneeFilter = document.getElementById('anneeFilter');

        if (type === 'jour') {
            moisFilter.style.display = 'block';
            jourFilter.style.display = 'block';
            anneeFilter.style.display = 'block';
        } else if (type === 'mois') {
            moisFilter.style.display = 'none';
            jourFilter.style.display = 'none';
            anneeFilter.style.display = 'block';
        } else {
            moisFilter.style.display = 'none';
            jourFilter.style.display = 'none';
            anneeFilter.style.display = 'none';
        }
    }

    // Fonction d'export
    function exportData() {
        const data = <?= json_encode($resultats ?? []) ?>;
        
        if (data.length === 0) {
            alert('Aucune donnée à exporter');
            return;
        }
        
        let csv = 'Période,Bénéfice (Ar)\n';
        data.forEach(row => {
            csv += `${row.periode},${row.benefice_total}\n`;
        });
        
        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'benefices_' + new Date().toISOString().slice(0,10) + '.csv';
        link.click();
    }

    // Initialisation
    updateFilters();
</script>

<?php 
$content = ob_get_clean();
$title = "Analyse des Bénéfices - Gestion de Livraison";
require __DIR__ . '/layout.php';