<?php

namespace App;

use Terranet\Administrator\Repository;

class ConstitutionType extends Repository
{
    public $timestamps = false;

    protected $casts = [
        'note' => 'json'
    ];

    public function getNote($scope)
    {
        return $this->note[$scope];
    }
}
