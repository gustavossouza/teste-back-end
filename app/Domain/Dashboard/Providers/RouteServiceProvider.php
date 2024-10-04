<?php

namespace App\Domain\Dashboard\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    protected $namespace = '\App\Domain\Dashboard\Controllers';

    public function register()
    {
        $this->mapApiRoutes();
    }

    protected function mapApiRoutes()
    {
        $this->app->router->group(
            ['middleware' => ['api'], 'prefix' => 'api/dashboard', 'namespace' => $this->namespace],
            function ($app) {
            require __DIR__.'/../routes/api.php';
        });
    }
}
