<?php

namespace App\Http\Controllers;

use App\Substructure\Managers\TesteManager;
use App\Substructure\Repositories\TesteRepository;
use Freelabois\LaravelQuickstart\Extendables\CrudController;
use Illuminate\Http\Client\Request;


class TesteController extends CrudController
{
    public function __construct(
        TesteManager    $manager,
        TesteRepository $repository
    )
    {
        parent::__construct($manager, $repository);
    }
}
