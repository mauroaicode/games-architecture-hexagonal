<?php

namespace Core\Shared\Domain;

interface CollectionInterface
{   //Interfaz con el método "all" para retornar una todos los datos, estará compartida en el BoundedContext
    public function all(): array;
}
