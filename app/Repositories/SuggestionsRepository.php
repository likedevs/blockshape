<?php

namespace App\Repositories;

class SuggestionsRepository extends Repository
{
    public function all()
    {
        return $this->createModel()->orderBy('rank')->paginate(10);
    }
}