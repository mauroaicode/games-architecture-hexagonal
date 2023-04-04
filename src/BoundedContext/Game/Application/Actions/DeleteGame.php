<?php

namespace Core\BoundedContext\Game\Application\Actions;

use Core\BoundedContext\Game\Domain\GameRepository;
use Core\BoundedContext\Game\Domain\ValueObjects\GameId;
use Core\BoundedContext\Game\Application\Responses\GameResponse;

final class DeleteGame
{
    private $repository;

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): GameResponse
    {
        $id = new GameId($id);
        $game = $this->repository->find($id);

        $this->repository->delete($id);
        return GameResponse::fromGame($game);
    }
}
