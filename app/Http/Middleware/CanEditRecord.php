<?php

namespace App\Http\Middleware;

use App\User;
use App\UserHistory;
use Auth;
use Closure;

class CanEditRecord
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! (Auth::check() && $this->allows(Auth::user(), $request->route('record')))) {
            abort(422, 'Permission denied');
        }

        return $next($request);
    }

    protected function allows(User $user, UserHistory $history = null)
    {
        return $this->noRecordExists($history)
        || $this->userOwnsRecord($user, $history);
    }

    /**
     * @param User $user
     * @param UserHistory $history
     * @return bool
     */
    protected function userOwnsRecord(User $user, UserHistory $history)
    {
        return $user->isInstructor() && ($history->instructor_id == $user->id);
    }

    /**
     * @param UserHistory $history
     * @return bool
     */
    protected function noRecordExists(UserHistory $history = null)
    {
        return is_null($history);
    }
}
