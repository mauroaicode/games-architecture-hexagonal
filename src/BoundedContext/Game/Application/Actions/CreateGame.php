<?php

namespace Core\BoundedContext\Game\Application\Actions;

use Core\BoundedContext\Game\Domain\Game;
use Core\BoundedContext\Game\Domain\GameRepository;
use Core\BoundedContext\Game\Domain\GameAlreadyExists;
use Core\BoundedContext\Game\Domain\ValueObjects\GameId;
use Core\BoundedContext\Game\Domain\ValueObjects\GameUrl;
use Core\BoundedContext\Game\Domain\ValueObjects\GameName;
use Core\BoundedContext\Game\Domain\ValueObjects\GameState;
use Core\BoundedContext\Game\Domain\ValueObjects\GamePathImage;
use Core\BoundedContext\Game\Application\Responses\GameResponse;
use Core\BoundedContext\Game\Domain\ValueObjects\GameDescription;

final class CreateGame
{
    private $repository;

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws GameAlreadyExists
     */
    public function __invoke(string $id, string $name, string $description, string $pathImage, string $url, bool $state): GameResponse
    {
        $id = new GameId($id);
        $name = new GameName($name);
        $description = new GameDescription($description);
        $pathImage = new GamePathImage($pathImage);
        $url = new GameUrl($url);
        $state = new GameState($state);
        $game = Game::create($id, $name, $description, $pathImage, $url, $state);

        $this->repository->save($game);

        return GameResponse::fromGame($game);
    }
}
