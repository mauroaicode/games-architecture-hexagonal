<?php

namespace Core\BoundedContext\Game\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Core\BoundedContext\Game\Application\Actions\ListGames;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Core\BoundedContext\Game\Infrastructure\Persistence\Eloquent\GameRepository;

final class ListGamesGetController extends Controller
{
    private $repository;

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): JsonResponse
    {
        $gamesResponse = (new ListGames($this->repository))(); //Llamamos el CASO DE USO DeleteGame que es una acción para listar juegos

        return new JsonResponse([
            'data' => $gamesResponse->toArray()
        ], ResponseAlias::HTTP_OK);
    }
}
