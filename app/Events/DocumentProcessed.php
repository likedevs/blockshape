<?php

namespace App\Events;

use App\User;
use App\UserHistory;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DocumentProcessed extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var UserHistory
     */
    protected $record;

    /**
     * @var User
     */
    protected $user;

    /**
     * Create a new event instance.
     *
     * @param UserHistory $record
     */
    public function __construct(UserHistory $record)
    {
        $this->record = $record->toArray();
        $this->user = $record->user->toArray();
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        $channel = "history.processed.{$this->record['instructor_id']}";
        \Log::debug("Broadcasting to: {$channel}");

        return [$channel];
    }

    public function broadcastAs()
    {
        return 'DocumentProcessed';
    }

    public function broadcastWith()
    {
        return [
            'record' => $this->record['id'],
            'user'   => $this->user['name'],
            'status' => $this->record['status'],
            'reason' => $this->record['declineReason']
        ];
    }
}
