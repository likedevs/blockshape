<?php

namespace App;

use Illuminate\Http\Request;
use Terranet\Administrator\Repository;

class Site extends Repository
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'domain', 'currency'
    ];

    public function setDomainAttribute($value)
    {
        $this->attributes['domain'] = parse_url($value, PHP_URL_HOST);
    }

    static public function resolveRequest(Request $request)
    {
        $self = new self();

        return $self->whereDomain($request->server('HTTP_HOST'))->firstOrFail();
    }

    public function basename()
    {
        $parts = explode('.', $this->domain);

        return implode('.', array_slice($parts, -2));
    }
}
