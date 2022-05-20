<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Terranet\Administrator\Model\Language;

class MRation extends Model
{
    protected $table = 'media_rations';

    protected $fillable = ['user_id', 'date', 'day', 'food_1', 'food_2', 'food_3', 'food_4', 'food_5', 'type', 'traning', 'details', 'video_id'];

    public function video()
    {
        return $this->hasOne(Video::class, 'id', 'video_id');
    }
}
