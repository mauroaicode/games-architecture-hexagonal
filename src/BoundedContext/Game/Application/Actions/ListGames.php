<?php

namespace Core\BoundedContext\Game\Application\Actions;

use Core\BoundedContext\Game\Domain\GameRepository;
use Core\BoundedContext\Game\Application\Responses\GamesResponse;

final class ListGames
{
    private GameRepository $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $games = $this->repository->list();
        return GamesResponse::fromGames($games);
    }
}
