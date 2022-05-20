<?php

namespace App\Services\Contracts;

use App\Recipe\Params;

interface RecipeFinder
{
    /**
     * @param Params $params
     * @return mixed
     */
    public function find(Params $params);
}