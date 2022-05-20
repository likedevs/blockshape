<?php

namespace App;

use Terranet\Administrator\Repository;


class MProjects extends Repository
{
    protected $table = 'media_projects';

    protected $fillable = ['lang_id', 'title', 'slug', 'image', 'body', 'link'];
}
