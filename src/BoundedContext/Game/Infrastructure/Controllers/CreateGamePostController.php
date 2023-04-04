<?php
declare(strict_types=1);

namespace Core\BoundedContext\Game\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Core\Shared\Domain\StorageImage;
use App\Http\Controllers\Controller;
use Core\Shared\Domain\UuidGenerator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Core\BoundedContext\Game\Application\Actions\CreateGame;
use Core\BoundedContext\Game\Infrastructure\FormRequest\GameRequest;
use Core\BoundedContext\Game\Infrastructure\Persistence\Eloquent\GameRepository;
/*=============================================
CONTROLADOR QUE PERMITE SOLAMENTE CREAR UN JUEGO
=============================================*/
final class CreateGamePostController extends Controller
{
    private $uuidGenerator;
    private $storageImage;
    private $repository;

    public function __construct(UuidGenerator $uuidGenerator, GameRepository $repository, StorageImage $storageImage)
    {
        $this->uuidGenerator = $uuidGenerator; //Para generar un Uuid
        $this->storageImage = $storageImage; //Para guardar una imagen al storage
        $this->repository = $repository; //Repositorio
    }

    /**
     * @throws
     */
    public function __invoke(GameRequest $request): JsonResponse
    {
        $id = $request->get('id', $this->uuidGenerator->generate()); //Generamos el Uuid
        $pathImage = $request->get('pathImage');
        if ($request->get('pathImageUrl')){ //Validamos que la imagen que llega es una url o una para almacenar al storage
            $pathImage = $this->storageImage->saveImage($pathImage, 'games'); //Guardamos la imagen en el storage y recibimos el path
        }
        $gameResponse = (new CreateGame($this->repository))( //Llamamos el CASO DE USO CreateGame que es una acción para guardar en la base de datos
            $id, //id generado con Uuid
            $request->get('name'),
            $request->get('description'),
            $pathImage, //path de la imagen, sea si es una url o del storage
            $request->get('url'),
            $request->get('state')
        );

        return new JsonResponse(
            [
                'create_game' => $gameResponse->toArray()
            ],
            status: ResponseAlias::HTTP_OK,
        );
    }
}
