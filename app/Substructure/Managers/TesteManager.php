<?php

namespace App\Substructure\Managers;

use App\Substructure\Repositories\TesteRepository;

class TesteManager extends BaseManager
{
    public function __construct(TesteRepository $repository)
    {
        $this->repository = $repository;
    }
}
