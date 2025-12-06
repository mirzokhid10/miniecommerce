<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    public const HOME = "/user/dashboard";
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // $this->configureRateLimiting();

        $this->routes(function () {

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'auth', RoleMiddleware::class . ':admin'])
                ->prefix('admin')
                ->as('admin.')
                ->group(base_path('routes/admin.php'));
        });
    }

    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\SetLocale::class,
        ],
    ];
}
