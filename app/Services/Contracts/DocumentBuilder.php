<?php


namespace App\Services\Contracts;

use App\User;
use App\UserHistory;

interface DocumentBuilder
{
    /**
     * Build the document
     *
     * @param User        $user
     * @param UserHistory $record
     * @return $this
     */
    public function build(User $user, UserHistory $record);
}
