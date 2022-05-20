<?php

namespace App\Traits\Models;

trait UserScopes
{

    /**
     * Select only members
     *
     * @param $query
     * @return mixed
     */
    public function scopeMember($query)
    {
        return $query->where('role', 'member');
    }

    /**
     * Select only members
     *
     * @param $query
     * @return mixed
     */
    public function scopeInstructor($query)
    {
        return $query->where('role', 'instructor');
    }

    /**
     * Select only admins
     *
     * @param $query
     * @return mixed
     */
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Select only managers
     *
     * @param $query
     * @return mixed
     */
    public function scopeManager($query)
    {
        return $query->where('role', 'manager');
    }

    /**
     * Fetch online users
     *
     * @param $query
     * @return mixed
     */
    public function scopeOnlineCustomer($query)
    {
        return $query->whereOnline(1);
    }

    /**
     * Fetch only offline users
     *
     * @param $query
     * @return mixed
     */
    public function scopeOfflineCustomer($query)
    {
        return $query->whereOnline(0);
    }
}