<?php

declare(strict_types=1);

namespace Core\Shared\Domain;
//En este caso usamos las excepciones de php
use Exception;
//Se usa para mostrar una excepción si existe o no una entidad
abstract class DomainException extends Exception {}
