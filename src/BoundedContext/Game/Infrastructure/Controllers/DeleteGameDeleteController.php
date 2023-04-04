<?php

namespace Core\BoundedContext\Game\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Core\BoundedContext\Game\Application\Actions\DeleteGame;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Core\BoundedContext\Game\Infrastructure\Persistence\Eloquent\GameRepository;

class DeleteGameDeleteController extends Controller
{
    private $repository;

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id): JsonResponse
    {
        $gameResponse = (new DeleteGame($this->repository))($id); //Llamamos el CASO DE USO DeleteGame que es una acción para eliminar el juego
        return new JsonResponse([
            'game_delete' => $gameResponse->toArray()
        ], ResponseAlias::HTTP_OK);
    }
}
