<?php ob_start(); ?>

<div class="error-container d-flex align-items-center justify-content-center" style="min-height: calc(100vh - 200px);">
    <div class="text-center">
        <!-- Illustration animée -->
        <div class="error-illustration mb-5">
            <div class="error-code-wrapper">
                <h1 class="error-code" style="font-size: 10rem; font-weight: 900; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 1; margin: 0;">
                    404
                </h1>
                <div class="floating-truck">
                    <i class="fas fa-truck" style="font-size: 4rem; color: #667eea; opacity: 0.2; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                </div>
            </div>
        </div>

        <!-- Message d'erreur -->
        <div class="error-content">
            <h2 class="mb-3" style="font-weight: 700; font-size: 2.5rem; color: #1a1d29;">Page introuvable</h2>
            <p class="lead text-muted mb-4" style="font-size: 1.25rem; max-width: 600px; margin: 0 auto;">
                Oups ! La page que vous recherchez semble avoir pris une mauvaise route. 
                Elle n'existe pas ou a été déplacée.
            </p>

            <!-- Actions -->
            <div class="d-flex gap-3 justify-content-center flex-wrap mt-5">
                <a href="<?= BASE_URL ?>" class="btn btn-lg px-5 py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 12px; font-weight: 600; box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);">
                    <i class="fas fa-home me-2"></i>Retour à l'accueil
                </a>
                <button onclick="history.back()" class="btn btn-outline-secondary btn-lg px-5 py-3" style="border-radius: 12px; font-weight: 600; border-width: 2px;">
                    <i class="fas fa-arrow-left me-2"></i>Page précédente
                </button>
            </div>

            <!-- Suggestions -->
            <div class="mt-5 pt-4">
                <p class="text-muted mb-3" style="font-weight: 600;">Pages suggérées :</p>
                <div class="d-flex gap-2 justify-content-center flex-wrap">
                    <a href="<?= BASE_URL ?>livraisons" class="badge bg-light text-dark px-3 py-2" style="text-decoration: none; border-radius: 8px; font-weight: 500; font-size: 0.9rem;">
                        <i class="fas fa-shipping-fast me-1"></i>Livraisons
                    </a>
                    <a href="<?= BASE_URL ?>chauffeurs" class="badge bg-light text-dark px-3 py-2" style="text-decoration: none; border-radius: 8px; font-weight: 500; font-size: 0.9rem;">
                        <i class="fas fa-user-tie me-1"></i>Chauffeurs
                    </a>
                    <a href="<?= BASE_URL ?>vehicules" class="badge bg-light text-dark px-3 py-2" style="text-decoration: none; border-radius: 8px; font-weight: 500; font-size: 0.9rem;">
                        <i class="fas fa-car me-1"></i>Véhicules
                    </a>
                    <a href="<?= BASE_URL ?>benefices" class="badge bg-light text-dark px-3 py-2" style="text-decoration: none; border-radius: 8px; font-weight: 500; font-size: 0.9rem;">
                        <i class="fas fa-chart-line me-1"></i>Bénéfices
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
$title = "404 - Page introuvable";
require __DIR__ . '/../layout.php';