<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailConfirmation extends Model
{
    public $timestamps = false;

    protected $fillable = ['email', 'token', 'confirmed_at'];

    public $dates = ['confirmed_at'];
}
