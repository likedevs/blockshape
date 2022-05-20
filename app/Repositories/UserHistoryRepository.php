<?php namespace App\Repositories;

use App\User;
use App\UserHistory;
use Carbon\Carbon;

class UserHistoryRepository extends Repository
{
    /**
     * Insert new record
     *
     * @param User $user
     * @param array $data
     * @return mixed
     */
    public function insert(User $user, array $data)
    {
        return $user->history()->create($data);
    }

    /**
     * Update record
     *
     * @param UserHistory $object
     * @param array $data
     * @return bool
     */
    public function update(UserHistory $object, array $data)
    {
        $object->fill($data)->save();

        return $object;
    }

    /**
     * Find a history record by user and date
     *
     * @param User $user
     * @param Carbon $date
     * @return mixed
     */
    public function find(User $user, Carbon $date)
    {
        return $this->createModel()->where([
            'user_id' => $user->id,
            'created_at' => $date->toDateString()
        ])->first();
    }

    public function findOne($id, $userId = null)
    {
        $query = $this->createModel()->whereId((int)$id);

        if ($userId) {
            $query->where('user_id', (int)$userId);
        }

        return $query->first();
    }

    /**
     * Fetch all history of user created by instructor
     *
     * @param User $user
     * @param User $instructor
     * @return mixed
     */
    public function createdForUserByInstructor(User $user, User $instructor)
    {
        return $this->createModel()->ofUser($user)->byInstructor($instructor)->get();
    }
}