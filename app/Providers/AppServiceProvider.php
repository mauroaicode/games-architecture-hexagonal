<?php

namespace App\Providers;

use Core\Shared\Domain\StorageImage;
use Core\Shared\Domain\UuidGenerator;
use Core\Shared\Infrastructure\RamseyUuidGenerator;
use Core\Shared\Infrastructure\SaveImageStorage;
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
        //Instanciamos la interface UuidGenerator contra la clase RamseyUuidGenerator
        $this->app->bind(
            UuidGenerator::class,
            RamseyUuidGenerator::class,
        );
        //Instanciamos la interface StorageImage contra la clase SaveImagenStorage
        $this->app->bind(
            StorageImage::class,
            SaveImageStorage::class,
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
