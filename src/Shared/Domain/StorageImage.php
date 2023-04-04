<?php

namespace Core\Shared\Domain;

interface StorageImage
{   //Interfaz con función para guardar imagen, recibe la imagen y el nombre de la carpeta donde se guardará
    public function saveImage($image, $folder);
}
