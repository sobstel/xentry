<?php

namespace Xentry\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Xentry\Events\Event;
use Xentry\Models\FollowerRef;

abstract class AbstractUserFollowRef extends Event
{
    use SerializesModels;

    /**
     * @var int
     */
    public $user_id;

    /**
     * @var int
     */
    public $follower_id;

    /**
     * Create a new event instance.
     *
     * @param int $user_id
     * @param int $follower_id
     * @return void
     */
    public function __construct($user_id, $follower_id)
    {
        $this->user_id = $user_id;
        $this->follower_id = $follower_id;
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
