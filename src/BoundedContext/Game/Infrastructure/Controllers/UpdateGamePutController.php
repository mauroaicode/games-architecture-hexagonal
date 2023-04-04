<?php

namespace Core\BoundedContext\Game\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Core\Shared\Domain\StorageImage;
use Core\BoundedContext\Game\Application\Actions\CreateGame;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Core\BoundedContext\Game\Infrastructure\FormRequest\GameRequest;
use Core\BoundedContext\Game\Infrastructure\Persistence\Eloquent\GameRepository;

class UpdateGamePutController extends Controller
{
    private $repository;
    private $storageImage;

    public function __construct(GameRepository $repository, StorageImage $storageImage)
    {
        $this->repository = $repository;
        $this->storageImage = $storageImage;
    }

    /**
     * @throws \Core\BoundedContext\Game\Domain\GameAlreadyExists
     */
    public function __invoke(GameRequest $request, $id): JsonResponse
    {
        $pathImage = $request->get('pathImage');
        if ($request->get('pathImageUrl')){//Validamos que la imagen que llega es una url o una para almacenar al storage
            $pathImage = $this->storageImage->saveImage($pathImage, 'games'); //Guardamos la imagen en el storage y recibimos el path
        }
        $gameResponse = (new CreateGame($this->repository))( //Llamamos el CASO DE USO CreateGame que es una acción para guardar (luego validamos si el juego existe para actualizar
            $id,
            $request->get('name'),
            $request->get('description'),
            $pathImage,
            $request->get('url'),
            $request->get('state'),
        );

        return new JsonResponse(
            [
                'update_game' => $gameResponse->toArray()
            ],
            status: ResponseAlias::HTTP_OK,
        );
    }

}
