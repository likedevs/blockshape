<?php

namespace App\Events;

use App\Events\Event;
use App\UserHistory;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DocumentConfirmed extends Event
{
    use SerializesModels;
    /**
     * @var UserHistory
     */
    public $record;

    /**
     * Create a new event instance.
     *
     * @param UserHistory $record
     */
    public function __construct(UserHistory $record)
    {
        $this->record = $record;
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
