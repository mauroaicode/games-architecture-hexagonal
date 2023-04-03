<?php

namespace App\Providers;

use Core\Shared\Domain\UuidGenerator;
use Core\Shared\Infrastructure\RamseyUuidGenerator;
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
        $this->app->bind(
            UuidGenerator::class,
            RamseyUuidGenerator::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Cargar migraciones del BoundedContext
         */
        $this->loadMigrationsFrom(
            \File::allFiles(base_path("src/BoundedContext/**/Infrastructure/migrations"))
        );
        /**
         * Cargar seeders del BoundedContext
         */

    }
}
