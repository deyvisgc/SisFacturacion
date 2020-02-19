<?php

namespace App\Providers;

use App\Http\Interfaces\IngresoInterface;
use App\Http\Repositorios\IngresosRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IngresoInterface::class,IngresosRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
