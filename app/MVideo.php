<?php

namespace App;

use Terranet\Administrator\Repository;

class MVideo extends Repository
{
    protected $table = 'media_videos';

    protected $fillable = ['lang_id', 'title', 'text', 'video', 'video_file1', 'video_file2', 'video_file3',];
}
