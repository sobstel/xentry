<?php

namespace Xentry\Listeners;

use Xentry\Events\UserFollowed;
use Xentry\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

/**
 * User gets a new follower -> send email
 */
class FollowEmail
{
    /**
     * Handle the event.
     *
     * @param  UserWasFollowed  $event
     * @return void
     */
    public function handle(UserFollowed $event)
    {
        $user = User::find($event->user_id);
        $follower = User::find($event->follower_id);

        Mail::queue('emails.new_follower', ['user' => $user, 'follower' => $follower], function ($m) use ($user) {
            $m->from('p.sobstel@gmail.com', 'Xentry');

            $m->to($user->email, $user->name)->subject('You have a new follower!');
        });
    }
}
