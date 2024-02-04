<?php

namespace App\Http\Controllers;

use App\Substructure\Managers\TesteManager;
use App\Substructure\Repositories\TesteRepository;
use Freelabois\LaravelQuickstart\Extendables\CrudController;
use Illuminate\Http\Client\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      title="Nome da Sua API",
 *      version="1.0.0",
 *      description="Descrição da sua API"
 * )
 */

class TesteController extends CrudController
{
    public function __construct(
        TesteManager    $manager,
        TesteRepository $repository
    )
    {
        parent::__construct($manager, $repository);
    }


    /**
     * @OA\Get(
     *     path="/api/exemplo",
     *     operationId="getExemplo",
     *     tags={"Exemplo"},
     *     summary="Obter exemplo",
     *     description="Obtém um exemplo.",
     *     @OA\Response(response="200", description="Exemplo obtido com sucesso"),
     *     @OA\Response(response="404", description="Exemplo não encontrado")
     * )
     */
    public function index()
    {
        // dd('dfasd');
    }
}
