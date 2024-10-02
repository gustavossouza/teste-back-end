<?php

namespace App\Domain\Products\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    protected $namespace = '\App\Domain\Products\Controllers';

    public function register()
    {
        $this->mapApiRoutes();
    }

    protected function mapApiRoutes()
    {
        $this->app->router->group(
            ['middleware' => ['api'], 'prefix' => 'api/products', 'namespace' => $this->namespace],
            function ($app) {
            require __DIR__.'/../routes/api.php';
        });
    }
}
