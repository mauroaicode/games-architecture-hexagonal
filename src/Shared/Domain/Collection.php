<?php

declare(strict_types=1);

namespace Core\Shared\Domain;

abstract class Collection implements CollectionInterface
{
    private array $items;

    public function __construct(array $items = []) {
        $this->items = $items;
    }
    //Para retornar un array o colección de datos para todas las entidades implementa de la Interface CollectionInterface
    public function all(): array {
        return $this->items;
    }
}
