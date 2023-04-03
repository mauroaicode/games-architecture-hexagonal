<?php

namespace Core\BoundedContext\Game\Domain;

use Core\BoundedContext\Game\Domain\ValueObjects\{
    GameId, GameName, GameDescription, GamePathImage, GameUrl, GameState
};

class Game
{

    public function __construct(
        private GameId          $id,
        private GameName        $name,
        private GameDescription $description,
        private GamePathImage   $pathImage,
        private GameUrl         $url,
        private GameState       $state,
    )
    {
    }

    public static function fromPrimitives(string $id, string $name, string $description, string $pathImage, string $url, bool $state): self
    {

        return new self(
            new GameId($id),
            new GameName($name),
            new GameDescription($description),
            new GamePathImage($pathImage),
            new GameUrl($url),
            new GameState($state)
        );
    }

    public static function create(GameId $id, GameName $name, GameDescription $description, GamePathImage $pathImage, GameUrl $url, GameState $state): self
    {
        return new self(
            $id,
            $name,
            $description,
            $pathImage,
            $url,
            $state
        );
    }

    public function id(): GameId
    {
        return $this->id;
    }

    public function name(): GameName
    {
        return $this->name;
    }

    public function description(): GameDescription
    {
        return $this->description;
    }

    public function pathImage(): GamePathImage
    {
        return $this->pathImage;
    }

    public function url(): GameUrl
    {
        return $this->url;
    }

    public function state(): GameState
    {
        return $this->state;
    }
}
