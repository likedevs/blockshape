<?php

namespace App;

use Terranet\Administrator\Repository;

class MVideoStories extends Repository
{
    protected $table = "media_video_stories";

    protected $fillable = ['lag_id', 'video', 'date'];
}
