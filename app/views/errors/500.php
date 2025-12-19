<?php ob_start(); ?>

<div class="error-container d-flex align-items-center justify-content-center" style="min-height: calc(100vh - 200px);">
    <div class="text-center">
        <!-- Illustration animée -->
        <div class="error-illustration mb-5">
            <div class="error-code-wrapper">
                <h1 class="error-code" style="font-size: 10rem; font-weight: 900; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 1; margin: 0;">
                    500
                </h1>
                <div class="broken-gear">
                    <i class="fas fa-cog" style="font-size: 4rem; color: #f5576c; opacity: 0.2; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                </div>
            </div>
        </div>

        <!-- Message d'erreur -->
        <div class="error-content">
            <h2 class="mb-3" style="font-weight: 700; font-size: 2.5rem; color: #1a1d29;">Erreur serveur</h2>
            <p class="lead text-muted mb-4" style="font-size: 1.25rem; max-width: 600px; margin: 0 auto;">
                Une erreur technique s'est produite sur nos serveurs. 
                Nos équipes ont été notifiées et travaillent pour résoudre le problème.
            </p>

            <!-- Détails de l'erreur en mode développement -->
            <?php if (isset($error) && Flight::get('flight.environment') === 'development'): ?>
            <div class="alert alert-danger text-start mx-auto mt-4" style="max-width: 800px; border-radius: 12px; border-left: 4px solid #f5576c;">
                <h5 class="alert-heading mb-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>Détails de l'erreur (Mode développement)
                </h5>
                <p class="mb-2"><strong>Message :</strong> <?= htmlspecialchars($error->getMessage()) ?></p>
                <p class="mb-2"><strong>Fichier :</strong> <?= htmlspecialchars($error->getFile()) ?></p>
                <p class="mb-0"><strong>Ligne :</strong> <?= $error->getLine() ?></p>
                <hr>
                <pre class="mb-0" style="font-size: 0.85rem; max-height: 300px; overflow-y: auto; background: #f8f9fa; padding: 1rem; border-radius: 8px;"><?= htmlspecialchars($error->getTraceAsString()) ?></pre>
            </div>
            <?php endif; ?>

            <!-- Actions -->
            <div class="d-flex gap-3 justify-content-center flex-wrap mt-5">
                <a href="<?= BASE_URL ?>" class="btn btn-lg px-5 py-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border: none; border-radius: 12px; font-weight: 600; box-shadow: 0 8px 20px rgba(245, 87, 108, 0.3);">
                    <i class="fas fa-home me-2"></i>Retour à l'accueil
                </a>
                <button onclick="location.reload()" class="btn btn-outline-secondary btn-lg px-5 py-3" style="border-radius: 12px; font-weight: 600; border-width: 2px;">
                    <i class="fas fa-redo me-2"></i>Réessayer
                </button>
            </div>

            <!-- Contact support -->
            <div class="mt-5 pt-4">
                <div class="card border-0 shadow-sm mx-auto" style="max-width: 500px; border-radius: 16px; background: linear-gradient(135deg, rgba(240, 147, 251, 0.05) 0%, rgba(245, 87, 108, 0.05) 100%);">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">
                            <i class="fas fa-headset me-2" style="color: #f5576c;"></i>Besoin d'aide ?
                        </h5>
                        <p class="card-text text-muted mb-3">
                            Si le problème persiste, n'hésitez pas à contacter notre équipe support.
                        </p>
                        <a href="<?= BASE_URL ?>support" class="btn btn-outline-danger px-4 py-2" style="border-radius: 10px; font-weight: 600;">
                            <i class="fas fa-envelope me-2"></i>Contacter le support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
$title = "500 - Erreur serveur";
require __DIR__ . '/../layout.php';