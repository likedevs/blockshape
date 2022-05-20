<?php namespace App\Repositories;

use App\User;

class DepartmentsRepository extends Repository
{
    /**
     * Get list of all offices
     *
     * @return mixed
     */
    public function all()
    {
        return $this->createModel()->orderBy('name')->get();
    }

    /**
     * Get list of offices instsructor belongs to
     *
     * @param User $instructor
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function instructorBelongsTo(User $instructor)
    {
        return $instructor->offices;
    }
}