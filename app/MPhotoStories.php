<?php

namespace App;

use Terranet\Administrator\Repository;

class MPhotoStories extends Repository
{
    protected $table = "media_photo_stories";

    protected $fillable = ['lag_id', 'img', 'date', 'show_home'];
}
