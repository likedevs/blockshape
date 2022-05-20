<?php

namespace App\Events;

use App\Events\Event;
use App\User;
use App\UserHistory;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserHistoryCreated extends Event
{
    use SerializesModels;

    /**
     * @var UserHistory
     */
    private $record;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new event instance.
     *
     * @param UserHistory $record
     * @param User        $user
     */
    public function __construct(UserHistory $record, User $user)
    {
        $this->record = $record;

        $this->user = $user;
    }

    /**
     * @return UserHistory
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
