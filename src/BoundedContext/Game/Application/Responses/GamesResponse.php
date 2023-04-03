<?php

namespace Core\BoundedContext\Game\Application\Responses;

use Core\BoundedContext\Game\Domain\Games;

final class GamesResponse
{
    private array $games;

    public function __construct($games)
    {
        $this->games = $games;
    }

    public static function fromGames(Games $games)
    {
        $gamesResponses = array_map(
            function ($game) {
                return GameResponse::fromGame($game);
            },
            $games->all()
        );
        return new self($gamesResponses);
    }

    public function toArray(): array
    {
        return array_map(function (GameResponse $gameResponse) {
            return $gameResponse->toArray();
        }, $this->games);
    }
}
