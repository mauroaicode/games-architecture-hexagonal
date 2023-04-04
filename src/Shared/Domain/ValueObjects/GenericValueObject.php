<?php

namespace Core\Shared\Domain\ValueObjects;

abstract class GenericValueObject
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
    //Retornamos el valor de cualquier tipo, lo uso para la imagen, ya que puedo recibir un string o un objeto
    public function value()
    {
        return $this->value;
    }
}
