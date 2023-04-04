<?php

namespace Core\BoundedContext\Game\Application\Responses;

use Core\BoundedContext\Game\Domain\Game;

final class GameResponse
{
    private string $id;
    private string $name;
    private string $description;
    private $pathImage;
    private string $url;
    private bool $state;

    public function __construct($id, $name, $description, $pathImage, $url, $state)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->pathImage = $pathImage;
        $this->url = $url;
        $this->state = $state;
    }

    public static function fromGame(Game $game): self
    {
        return new self(
            $game->id()->value(),
            $game->name()->value(),
            $game->description()->value(),
            $game->pathImage()->value(),
            $game->url()->value(),
            $game->state()->value(),
        );

    }

    public function id(): string{
        return $this->id;
    }

    public function name(): string{
        return $this->name;
    }

    public function description(): string{
        return $this->description;
    }

    public function pathImage(){
        return $this->pathImage;
    }

    public function url(): string{
        return $this->url;
    }

    public function state(): bool{
        return $this->state;
    }

    public function toArray(): array{
        return [
          'id' => $this->id,
          'name' => $this->name,
          'description' => $this->description,
          'pathImage' => $this->pathImage,
          'url' => $this->url,
          'state' => $this->state,
        ];
    }

}
