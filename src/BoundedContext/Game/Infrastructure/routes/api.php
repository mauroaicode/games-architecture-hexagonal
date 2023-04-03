<?php
use \Core\BoundedContext\Game\Infrastructure\Controllers\{
    CreateGamePostController
};

Route::post('create/game', CreateGamePostController::class);
