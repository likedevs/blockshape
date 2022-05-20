<?php namespace App\Observers;

use App\Events\DocumentConfirmed;
use App\Events\UserHistoryCreated;
use App\Order;
use App\UserHistory;

class UserHistoryObserver
{
    /**
     * Fire an event when History Record created
     *
     * @param UserHistory $record
     * @return mixed
     */
    public function created(UserHistory $record)
    {
        $this->fireHistoryCreatedEvent($record);

        return $record;
    }

    /**
     * Rebuild the document if record changed
     *
     * @param UserHistory $record
     * @return UserHistory
     */
    public function updated(UserHistory $record)
    {
        if ($record->pending() && $record->isDirty()) {
            $this->fireHistoryCreatedEvent($record);
        }

        return $record;
    }

    public function updating(UserHistory $record)
    {
        if ($this->goesToPendingStatus($record)) {
            $record->document = null;
        }

        if ($this->goesToConfirmedStatus($record)) {
            $this->fireDocumentConfirmedEvent($record);
        }

        return $record;
    }

    private function goesToPendingStatus(UserHistory $record)
    {
        return (
            UserHistory::STATUS_PENDING == $record->getAttribute('status')
            && UserHistory::STATUS_PENDING != $record->getOriginal('status')
        );
    }

    private function goesToConfirmedStatus(UserHistory $record)
    {
        return (
            UserHistory::STATUS_CONFIRMED == $record->getAttribute('status')
            && UserHistory::STATUS_CONFIRMED != $record->getOriginal('status')
        );
    }

    /**
     * @param UserHistory $record
     * @return mixed
     */
    protected function findOrder(UserHistory $record)
    {
        return app('App\Repositories\OrdersRepository')->firstByOptions([
            'user_history_id' => $record->id,
        ]);
    }

    /**
     * @param UserHistory $record
     */
    private function fireHistoryCreatedEvent(UserHistory $record)
    {
        event(new UserHistoryCreated($record, $record->user));
    }

    /**
     * @param UserHistory $record
     */
    protected function fireDocumentConfirmedEvent(UserHistory $record)
    {
        event(new DocumentConfirmed($record));
    }
}
