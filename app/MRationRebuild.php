<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Terranet\Administrator\Model\Language;

class MRationRebuild extends Model
{
    protected $table = 'media_ration_rebuild';

    protected $fillable = ['user_id', 'date',  'food_1', 'food_2', 'food_3', 'food_4', 'food_5',  'actual'];

}
