<?php

namespace Core\BoundedContext\Game\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Core\BoundedContext\Game\Application\Actions\FindGame;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Core\BoundedContext\Game\Infrastructure\Persistence\Eloquent\GameRepository;

class FindGameGetController extends Controller
{
    private $repository;

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id): JsonResponse
    {
        $gameResponse = (new FindGame($this->repository))($id); //Llamamos el CASO DE USO FindGame que es una acción para buscar el juego por id
        return new JsonResponse([
            'find_game' => $gameResponse->toArray()
        ], ResponseAlias::HTTP_OK);
    }
}
