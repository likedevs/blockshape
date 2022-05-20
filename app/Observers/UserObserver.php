<?php

namespace App\Observers;

use App\User;
use Illuminate\Mail\Message;
use Mail;
use Terranet\Administrator\Model\Settings;

class UserObserver
{
    public function saving(User $user)
    {
        if ($this->isOfRole($user)) {
            if (empty($user->password) || $user->isDirty('password')) {
                $user->password = \Hash::make($password = $this->retrievePassword($user));
                $payload = [
                    'name' => $user->name,
                    'password' => $password,
                ];

                Mail::send('emails.instructor.password', $payload, function (Message $message) use ($user) {
                    $message->to($user->email);
                    $message->subject(trans('emails.instructor.password.subject'));
                    $message->from(Settings::getOption('admin::email'));
                });
            }
        }
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    protected function isOfRole(User $user)
    {
        return $user->isInstructor() || $user->isAdmin() || $user->isManager();
    }

    /**
     * @param User $user
     *
     * @return mixed|string
     */
    protected function retrievePassword(User $user)
    {
        if (empty($user->password)) {
            return str_random(8);
        }

        return $user->password;
    }

    public function creating(User $user)
    {
        if (! $user->site_id) {
            $user->site_id = site_id();
        }

        return $user;
    }
}
