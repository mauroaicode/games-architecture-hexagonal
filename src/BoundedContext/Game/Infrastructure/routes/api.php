<?php

use \Core\BoundedContext\Game\Infrastructure\Controllers\{
    FindGameGetController,
    ListGamesGetController,
    UpdateGamePutController,
    CreateGamePostController,
    DeleteGameDeleteController,
};
/*=============================================
 RUTAS PARA LA ENTIDAD GAME
=============================================*/
Route::get('games', ListGamesGetController::class); //Listar todos los juegos
Route::get('find/game/{id}', FindGameGetController::class); //Buscar juego por id
Route::post('create/game', CreateGamePostController::class); //Crear o agregar un nuevo juego
Route::put('update/game/{id}', UpdateGamePutController::class); //Actualizar el juego, se busca por id
Route::delete('delete/game/{id}', DeleteGameDeleteController::class); //Eliminar juego existente, se busca por id
