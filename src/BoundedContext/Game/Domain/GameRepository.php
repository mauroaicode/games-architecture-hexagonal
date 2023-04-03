<?php

namespace Core\BoundedContext\Game\Domain;

use Core\BoundedContext\Game\Domain\ValueObjects\GameId;
//Interfaz para las diferentes acciones, aplicando Patron Repository
interface GameRepository
{
    public function list(): Games;

    public function save(Game $game): void;

    public function find(GameId $id): ?Game;

    public function delete(GameId $id): void;
}
