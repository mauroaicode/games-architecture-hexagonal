<?php

namespace Core\Shared\Infrastructure;

use Exception;
use Illuminate\Support\Str;
use Core\Shared\Domain\StorageImage;
use Illuminate\Support\Facades\Storage;
use Core\Shared\Infrastructure\Persistence\Eloquent\EloquentException;

final class SaveImageStorage implements StorageImage
{
    /**
     * @throws EloquentException
     */

    public function saveImage($image, $folder): string //función para guardar imagenes, estará disponible como compartida el BoundedContex
    {
        try {
            $randomName = 'game-' . Str::random(10) . '.' . $image['ext']; //Creamos el nombre de la imagen
            $file = file_get_contents($image['urlResized']); //Transformamos la imagen
            Storage::disk('public')->put('/' . $folder . '/' . $randomName, $file); //Guardamos en el storage la imagen la carpeta y su nombre correspondiente
            return '/storage/' . $folder . '/' . $randomName; // Retornamos path donde se almacenó la imagen para guardar en la DB
        } catch (Exception $e) {
            throw new EloquentException(
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious()
            );
        }
    }
}
