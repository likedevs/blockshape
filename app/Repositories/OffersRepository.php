<?php

namespace App\Repositories;

class OffersRepository extends Repository
{
    public function all($group = 'offline')
    {
        return $this->createModel()
            ->active()
            ->forSite(site_id())
            ->inGroup($group)
            ->get(['id', 'title', 'price', 'oldPrice', 'site_id']);
    }

    public function find($key)
    {
        return $this->createModel()
            ->whereId($key)
            ->first();
    }
}