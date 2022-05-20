<?php

namespace App;

use Terranet\Administrator\Repository;

class MRationTerm extends Repository
{
    protected $table = "media_ration_terms";

    protected $fillable = ['user_id', 'term_from', 'term_to'];

}
