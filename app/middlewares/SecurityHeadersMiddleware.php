<?php
declare(strict_types=1);

namespace app\middlewares;

use flight\Engine;
use Tracy\Debugger;

class SecurityHeadersMiddleware
{
    protected Engine $app;

    public function __construct(Engine $app)
    {
        $this->app = $app;
    }

    public function before(array $params): void
    {
        // CSP très permissif (dev / test)
        $csp = "default-src * 'unsafe-inline' 'unsafe-eval'; script-src * 'unsafe-inline' 'unsafe-eval'; style-src * 'unsafe-inline'; img-src * data:; connect-src *; font-src *; frame-src *;";

        $this->app->response()->header('X-Frame-Options', 'SAMEORIGIN');
        $this->app->response()->header("Content-Security-Policy", $csp);
        $this->app->response()->header('X-XSS-Protection', '1; mode=block');
        $this->app->response()->header('X-Content-Type-Options', 'nosniff');
        $this->app->response()->header('Referrer-Policy', 'no-referrer-when-downgrade');
        $this->app->response()->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        $this->app->response()->header('Permissions-Policy', 'geolocation=()');
    }

}
