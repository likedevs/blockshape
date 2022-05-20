<?php

namespace App\Traits\Models;

use App\Office;
use App\Order;
use App\Site;
use App\UserHistory;

trait UserRelations
{
    /**
     * Records History
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function history()
    {
        return $this->hasMany(UserHistory::class, 'user_id');
    }

    public function offices()
    {
        return $this->belongsToMany(Office::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, UserHistory::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}