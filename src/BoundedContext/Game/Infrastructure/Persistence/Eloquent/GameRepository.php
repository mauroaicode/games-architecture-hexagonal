<?php

namespace Core\BoundedContext\Game\Infrastructure\Persistence\Eloquent;

use Core\BoundedContext\Game\Domain\{
    Game,
    Games,
    ValueObjects\GameId,
    GameRepository as GameRepositoryContract,
};

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Core\Shared\Infrastructure\Persistence\Eloquent\EloquentException;

final class GameRepository implements GameRepositoryContract
{
    private $model;

    public function __construct(GameModel $model)
    {
        $this->model = $model; //Obtenemos el modelo el cual tiene funcionalidades de eloquent
    }
    //Para recibir los valores primitivos
    private function toDomain(GameModel $eloquentGameModel): Game
    {
        return Game::fromPrimitives(
            $eloquentGameModel->id,
            $eloquentGameModel->name,
            $eloquentGameModel->description,
            $eloquentGameModel->pathImage,
            $eloquentGameModel->url,
            $eloquentGameModel->state
        );
    }
    //Listar Juegos
    public function list(): Games
    {
        $eloquentGame = $this->model->orderBy('created_at','DESC')->get(); //Con eloquent obtenemos todos los juegos
        $games = $eloquentGame->map(
            function (GameModel $eloquentGame) {
                return $this->toDomain($eloquentGame); //Pasamos los datos primitivos
            }
        )->toArray();
        return new Games($games);
    }

    /**
     * @throws EloquentException
     */
    //Guardar Juego. Esta función no sirve para actualizar el juego también
    public function save(Game $game): void
    {
        $gameModel = $this->model->find($game->id()->value()); //Buscamos el juego en la DB

        if (null === $gameModel) { // Si no existe o null, creamos una instancia de Juego y asignamos el id al nuevo juego
            $gameModel = new GameModel();
            $gameModel->id = $game->id()->value();
        }// Si es que existe, no pasa a crear la instancia del juego y actualizamos los datos

        //Tomamos los datos para luego guardar el juego
        $gameModel->name = $game->name()->value();
        $gameModel->description = $game->description()->value();
        $gameModel->pathImage = $game->pathImage()->value();
        $gameModel->url = $game->url()->value();
        $gameModel->state = $game->state()->value();

        DB::beginTransaction();
        try {
            //Guardar Juego o Actualizar Juego
            $gameModel->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new EloquentException(
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious()
            );
        }
    }
    //Buscar Juego
    public function find(GameId $id): ?Game
    {
        $gameModel = $this->model->find($id->value());
        if (null === $gameModel) {
            throw new ModelNotFoundException('Juego no existe');
        }
        return $this->toDomain($gameModel);
    }
    //Eliminar Juego
    public function delete(GameId $id): void
    {
        $game = $this->model->find($id->value());
        if (null === $game) {
            throw new ModelNotFoundException('Juego no existe');
        }
        $game->delete();
    }
}
