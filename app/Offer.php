<?php

namespace App;

use Terranet\Administrator\Repository;

class Offer extends Repository
{
    protected $fillable = ['site_id', 'title', 'price', 'oldPrice', 'period', 'active'];

    protected $casts = [
        'currency' => 'string',
        'price' => 'double',
        'oldPrice' => 'double',
        'period' => 'int'
    ];

    protected $appends = [
        'currency'
    ];

    public function scopeActive($query)
    {
        return $query->whereActive(1);
    }

    public function scopeForSite($query, $siteId)
    {
        return $query->whereSiteId((int) $siteId);
    }

    public function scopeInGroup($query, $group)
    {
        return $query->whereGroup($group);
    }

    public function publicName()
    {
        return $this->period . ' zile - ' . $this->price . ' ' . $this->currency;
    }

    public function getCurrencyAttribute()
    {
        return ($site = $this->site) ? $site->currency : '';
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
