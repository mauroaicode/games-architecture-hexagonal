<?php

namespace App\Providers;


use Core\BoundedContext\Game\Domain\GameRepository;
use Illuminate\Support\ServiceProvider;
use Core\BoundedContext\Game\Infrastructure\Persistence\Eloquent\GameRepository as EloquentGameRepository;

class GameServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            GameRepository::class,
            EloquentGameRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
