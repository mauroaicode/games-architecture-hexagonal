<?php
declare(strict_types=1);

namespace Core\BoundedContext\Game\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Core\BoundedContext\Game\Application\Actions\CreateGame;
use Core\BoundedContext\Game\Infrastructure\FormRequest\GameRequest;
use Core\BoundedContext\Game\Infrastructure\Persistence\Eloquent\GameRepository;
use Core\Shared\Domain\UuidGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

final class CreateGamePostController extends Controller
{
    private $uuidGenerator;
    private $repository;

    public function __construct(UuidGenerator $uuidGenerator, GameRepository $repository)
    {
        $this->uuidGenerator = $uuidGenerator;
        $this->repository = $repository;
    }

    /**
     * @throws
     */
    public function __invoke(GameRequest $request): JsonResponse
    {
        $id = $request->get('id', $this->uuidGenerator->generate());

        $gameResponse = (new CreateGame($this->repository))(
            $id,
            $request->get('name'),
            $request->get('description'),
            $request->get('pathImage'),
            $request->get('url'),
            $request->get('state'),
        );

        return new JsonResponse(
            [
                'game' => $gameResponse->toArray()
            ],
            status: ResponseAlias::HTTP_OK,
        );
    }
}
