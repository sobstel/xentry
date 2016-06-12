<?php

namespace Xentry\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Xentry\Events\AbstractUserFollowRef;
use Xentry\Models\Activity;

abstract class AbstractActivity
{
    /**
     * Handle the event.
     *
     * @param  AbstractUserFollowRef  $event
     * @return void
     */
    public function handle(AbstractUserFollowRef $event)
    {
        $activity = new Activity;
        $activity->action = $this->getAction();
        $activity->from_user_id = $event->follower_id;
        $activity->to_user_id = $event->user_id;
        $activity->save();
    }

    /**
     * Action name.
     *
     * @return string
     */
    abstract protected function getAction();
}
