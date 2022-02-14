<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        $this->routes(function () {
            $this->mapGeneralRoutes();
            $this->mapAdminRoutes();
            $this->mapClientRoutes();
        });
    }

    /**
     * Call General Routes.
     */
    protected function mapGeneralRoutes()
    {
        Route::prefix('api')->group(base_path('routes/api.php'));
        Route::prefix('web')->middleware('api')->group(base_path('routes/web.php'));
    }

    /**
     * Call Admin Routes
     */
    protected function mapAdminRoutes()
    {
        $webFiles = glob(base_path('routes/Admin/*.php'));
        for ($i = 0; $i < count($webFiles); $i++) {
            Route::prefix('api/admin')
                ->middleware('api')
                ->middleware('activity_log')
                ->group($webFiles[$i]);
        }
    }

    /**
     * Call Admin Routes
     */
    protected function mapClientRoutes()
    {
        $webFiles = glob(base_path('routes/Client/*.php'));
        for ($i = 0; $i < count($webFiles); $i++) {
            Route::prefix('api/client')
                ->middleware('api')
                ->group($webFiles[$i]);
        }
    }


    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
