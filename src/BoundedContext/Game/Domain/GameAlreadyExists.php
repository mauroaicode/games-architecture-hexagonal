<?php
declare(strict_types=1);

namespace Core\BoundedContext\Game\Domain;

use Core\Shared\Domain\DomainException;
use Throwable;

class GameAlreadyExists extends DomainException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null) {
        $message = "" === $message ? "Juego ya existe" : $message;

        parent::__construct($message, $code, $previous);
    }
}
