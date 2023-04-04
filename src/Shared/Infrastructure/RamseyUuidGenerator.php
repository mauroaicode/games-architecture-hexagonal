<?php

namespace Core\Shared\Infrastructure;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Core\Shared\Domain\UuidGenerator;

//Generar Uuid String desde la carpeta Shared para todas las entidades
final class RamseyUuidGenerator implements UuidGenerator {
    public function generate(): string {
        return RamseyUuid::uuid4()->toString();
    }
}
