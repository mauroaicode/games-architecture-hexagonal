<?php

namespace Core\BoundedContext\Game\Application\Actions;

use Core\BoundedContext\Game\Application\Responses\GameResponse;
use Core\BoundedContext\Game\Domain\GameRepository;
use Core\BoundedContext\Game\Domain\ValueObjects\GameId;

final class FindGame
{
    private $repository;

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id)
    {
        $id = new GameId($id);
        $game = $this->repository->find($id);

        $this->repository->find($id);
        return GameResponse::fromGame($game);
    }
}
